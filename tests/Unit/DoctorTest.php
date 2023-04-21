<?php

namespace Tests\Unit;

use Tests\TestCase;

class DoctorTest extends TestCase
{
    public function test_create_doctor_with_required_fields(): void
    {
        $response = $this->postJson('/api/doctor', [
            'last_name' => 'Williams',
            'first_name' => 'Liam',
            'phone' => '+71234567889',
            'working_start_time' => '09:00',
            'working_end_time' => '17:00',
        ]);
        $response->assertStatus(200);
    }

    public function test_create_doctor_with_required_and_not_required_fields(): void
    {
        $response = $this->postJson('/api/doctor', [
            'last_name' => 'Harris',
            'first_name' => 'Rosa',
            'phone' => '+79876543221',
            'working_start_time' => '12:00',
            'working_end_time' => '16:00',
            'date_of_birth' => '1976-02-04 10:00:00',
            'middle_name' => 'Louise',
            'email' => 'rosa.harris@tempmail.com',
        ]);
        $response->assertStatus(200);
    }

    public function test_create_doctor_with_missing_required_field(): void
    {
        $response = $this->postJson('/api/doctor', [
            'last_name' => 'Scott',
            'phone' => '+79876543221',
            'working_start_time' => '08:00',
            'working_end_time' => '17:00',
        ]);
        $response->assertStatus(422);
    }

    public function test_create_doctor_with_missing_required_fields(): void
    {
        $response = $this->postJson('/api/doctor', [
            'last_name' => 'Nelson',
            'working_start_time' => '09:30',
            'working_end_time' => '13:30',
        ]);
        $response->assertStatus(422);
    }
}
