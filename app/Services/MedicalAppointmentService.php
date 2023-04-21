<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\MedicalAppointment;
use App\Models\Patient;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MedicalAppointmentService
{
    private const DURATION = '30 minutes';

    /**
     * @throws Exception
     */
    public static function create(array $data): void
    {
        self::checkAppointmentAvailability($data);
        MedicalAppointment::create($data);
    }

    /**
     * @throws Exception
     */
    private static function checkAppointmentAvailability(array $data): void
    {
        $doctor = Doctor::find($data['doctor_id']);
        $patient = Patient::find($data['patient_id']);
        if (!$doctor || !$patient) {
            throw new HttpException(400, 'Invalid data');
        }

        $appointmentEndDateTime = strtotime($data['date'] . '+' . self::DURATION);

        if (date("H:i:s", strtotime($data['date'])) < $doctor->working_start_time
            || date("H:i:s", $appointmentEndDateTime) > $doctor->working_end_time) {
            throw new HttpException(400, 'It`s doctor`s off hours');
        }

        $from = date("Y-m-d H:i:s", strtotime($data['date'] . '-' . self::DURATION));
        $to = date("Y-m-d H:i:s", $appointmentEndDateTime);
        $appointments = MedicalAppointment::where('doctor_id', $data['doctor_id'])
            ->whereBetween(
                'date',
                [$from, $to]
            )->get();
        if ($appointments->isNotEmpty()) {
            throw new HttpException(400, 'This time is not available for an appointment with a doctor');
        }
    }
}
