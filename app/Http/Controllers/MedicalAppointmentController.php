<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalAppointmentCreateRequest;
use App\Models\MedicalAppointment;
use App\Services\MedicalAppointmentService;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedicalAppointmentController extends Controller
{
    const PER_PAGE = 10;
    const AVAILABLE_SORT = ['asc', 'desc'];

    public function create(MedicalAppointmentCreateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            MedicalAppointmentService::create($data);
            return \response()->json(['status' => 'Medical appointment created successfully']);
        } catch (Exception $e) {
            return \response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }

    public function list(Request $request): LengthAwarePaginator
    {
        $appointmentQuery = MedicalAppointment::with(['doctor', 'patient']);
        if (isset($request->filter['doctor']['lastName'])) {
            $appointmentQuery->whereRelation(
                'doctor',
                'lastName',
                '=',
                $request->filter['doctor']['lastName']
            );
        }
        if (isset($request->filter['doctor']['firstName'])) {
            $appointmentQuery->whereRelation(
                'doctor',
                'firstName',
                '=',
                $request->filter['doctor']['firstName']
            );
        }
        if (isset($request->filter['doctor']['middleName'])) {
            $appointmentQuery->whereRelation(
                'doctor',
                'middle_name',
                '=',
                $request->filter['doctor']['middleName']
            );
        }

        if (isset($request->filter['patient']['lastName'])) {
            $appointmentQuery->whereRelation(
                'patient',
                'lastName',
                '=',
                $request->filter['patient']['lastName']
            );
        }
        if (isset($request->filter['patient']['firstName'])) {
            $appointmentQuery->whereRelation(
                'patient',
                'firstName',
                '=',
                $request->filter['patient']['firstName']
            );
        }
        if (isset($request->filter['patient']['middleName'])) {
            $appointmentQuery->whereRelation(
                'patient',
                'middleName',
                '=',
                $request->filter['patient']['middleName']
            );
        }

        if (isset($request->filter['date']['from'])) {
            $appointmentQuery->where('date', '>=', $request->filter['date']['from']);
        }
        if (isset($request->filter['date']['to'])) {
            $appointmentQuery->where('date', '<=', $request->filter['date']['to']);
        }

        if (isset($request->sortOrder) && in_array($request->sortOrder, self::AVAILABLE_SORT)) {
            $appointmentQuery->orderBy('date', $request->sortOrder);
        }

        return $appointmentQuery->paginate(self::PER_PAGE);
    }
}
