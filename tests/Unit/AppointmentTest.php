<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Patient;
use App\Models\Diagnose;
use App\Models\Service;

class AppointmentTest extends TestCase
{
    use RefreshDatabase; // Tambahkan ini

    /**
     * Test endpoint POST /api/appointment.
     */
    public function test_create_appointment()
    {
        // Buat data dummy
        $patient = Patient::create(['name' => 'Test Patient']);
        $service = Service::create(['name' => 'Test Service']);
        $diagnose = Diagnose::create([
            'name' => 'Test Diagnose',
            'service' => json_encode([$service->id]),
        ]);

        // Kirim permintaan POST ke endpoint
        $response = $this->postJson('/api/appointment', [
            'patient_id' => $patient->id,
            'diagnose_id' => $diagnose->id,
        ]);

        // Assert respons dan data
        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Appointment created successfully.',
            'data' => [
                'patient_id' => (string) $patient->id,
                'diagnose_id' => (string) $diagnose->id,
            ],
        ]);

        $this->assertDatabaseHas('appointments', [
            'patient_id' => $patient->id,
            'diagnose_id' => $diagnose->id,
        ]);
    }
}
