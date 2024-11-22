<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Jobs\ProcessCheckupProgress;


class AppointmentController extends Controller
{
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = DB::transaction(function () use ($request) {
            $appointment = Appointment::create($request->validated());

            // Dispatch job untuk memproses checkup progress
            ProcessCheckupProgress::dispatch($appointment);

            return $appointment;
        });

        return response()->json([
            'message' => 'Appointment created successfully.',
            'data' => $appointment,
        ], 201);
    }


    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'diagnose', 'checkupProgress.service'])->findOrFail($id);

        return response()->json([
            'id' => $appointment->id,
            'patient' => [
                'id' => $appointment->patient->id,
                'name' => $appointment->patient->name,
            ],
            'diagnose' => [
                'id' => $appointment->diagnose->id,
                'name' => $appointment->diagnose->name,
            ],
            'checkup' => $appointment->checkupProgress->map(function ($progress) {
                return [
                    'id' => $progress->id,
                    'service' => [
                        'id' => $progress->service->id,
                        'name' => $progress->service->name,
                    ],
                    'status' => $progress->status,
                ];
            }),
            'status' => $appointment->status,
        ]);
    }

    public function update(UpdateAppointmentRequest $request, $id)
    {
        // Temukan janji temu berdasarkan ID
        $appointment = Appointment::findOrFail($id);

        // Perbarui status janji temu
        $appointment->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Appointment updated successfully.',
            'data' => $appointment,
        ]);
    }


}
