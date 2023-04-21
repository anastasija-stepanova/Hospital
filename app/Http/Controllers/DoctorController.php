<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorCreateRequest;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function create(DoctorCreateRequest $request): string
    {
        try {
            $data = $request->validated();
            Doctor::create($data);
            return \response()->json(['status' => 'Doctor created successfully']);
        } catch (\Exception $e) {
            return \response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    }
}
