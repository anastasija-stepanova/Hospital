<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientCreateRequest;
use App\Models\Patient;

class PatientController extends Controller
{
    public function create(PatientCreateRequest $request): string
    {
        try {
            $data = $request->validated();
            Patient::create($data);
            return \response()->json(['status' => 'Patient created successfully']);
        } catch (\Exception $e) {
            return \response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }
}
