<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalAppointmentCreateRequest;
use App\Services\MedicalAppointmentService;
use Exception;
use Illuminate\Http\JsonResponse;

class MedicalAppointmentController extends Controller
{public function create(MedicalAppointmentCreateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            MedicalAppointmentService::create($data);
            return \response()->json(['status' => 'Medical appointment created successfully']);
        } catch (Exception $e) {
            return \response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }
}
