<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class MedicalAppointmentTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_create_appointment_with_start_time(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 10:00:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_create_appointment_with_some_working_hours(): void
    {
        $data = [
            'doctor_id' => 3,
            'patient_id' => 7,
            'date' => '2023-06-02 14:00:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_create_appointment_with_last_time_in_working_day(): void
    {
        $data = [
            'doctor_id' => 5,
            'patient_id' => 13,
            'date' => '2023-06-02 17:30:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_create_appointment_with_not_exists_doctor(): void
    {
        $data = [
            'doctor_id' => 1000,
            'patient_id' => 1,
            'date' => '2023-06-02 10:00:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_not_exists_patient(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1000,
            'date' => '2023-06-02 10:00:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_doctor_off_hours(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 08:00:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_1_min_before_start_working_day(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 09:59:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_1_sec_before_start_working_day(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 09:59:59',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_1_min_after_start_working_day(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 18:01:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_1_sec_after_start_working_day(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 18:00:01',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_1_min_before_end_working_day(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 17:59:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_1_sec_before_end_working_day(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 17:59:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_29_min_before_end_working_day(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 17:31:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointment_with_29_min_59_sec_before_end_working_day(): void
    {
        $data = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 17:30:01',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $data);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function test_create_appointments_with_crossing_time(): void
    {
        $firstAppointment = [
            'doctor_id' => 1,
            'patient_id' => 1,
            'date' => '2023-06-02 10:00:00',
        ];
        $this->call('POST', 'http://localhost/api/appointment', $firstAppointment);

        $secondAppointment = [
            'doctor_id' => 1,
            'patient_id' => 2,
            'date' => '2023-06-02 10:25:00',
        ];
        $response = $this->call('POST', 'http://localhost/api/appointment', $secondAppointment);
        $this->assertEquals(400, $response->getStatusCode());
    }
}
