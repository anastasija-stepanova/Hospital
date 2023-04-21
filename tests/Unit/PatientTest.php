<?php

namespace Tests\Unit;

use Tests\TestCase;

class PatientTest extends TestCase
{
    public function test_create_patient_with_required_fields_last_name(): void
    {
        $response = $this->postJson('/api/patient', [
            'last_name' => 'Morgan',
            'snils' => '123-456-789 00',
        ]);
        $response->assertStatus(200);
    }

    public function test_create_patient_with_required_fields_first_name(): void
    {
        $response = $this->postJson('/api/patient', [
            'first_name' => 'Ron',
            'snils' => '123-456-788 00',
        ]);
        $response->assertStatus(200);
    }

    public function test_create_patient_with_required_fields_middle_name(): void
    {
        $response = $this->postJson('/api/patient', [
            'middle_name' => 'Grace',
            'snils' => '123-456-787 00',
        ]);
        $response->assertStatus(200);
    }

    public function test_create_doctor_with_all_fields(): void
    {
        $response = $this->postJson('/api/patient', [
            'last_name' => 'Morgan',
            'first_name' => 'Ron',
            'middle_name' => 'Grace',
            'snils' => '123-456-785 00',
            'date_of_birth' => '1997-06-02 20:50:56',
            'address' => '2880 Broadway, New York, NY 10025, USA',
        ]);
        $response->assertStatus(200);
    }

    public function test_create_doctor_with_missing_required_field_snils(): void
    {
        $response = $this->postJson('/api/patient', [
            'last_name' => 'Moody',
        ]);
        $response->assertStatus(422);
    }

    public function test_create_doctor_with_missing_required_field_one_of_names(): void
    {
        $response = $this->postJson('/api/patient', [
            'snils' => '123-456-786 00',
        ]);
        $response->assertStatus(422);
    }
}
