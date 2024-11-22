<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Models\CheckupProgress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCheckupProgress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $appointment;

    /**
     * Create a new job instance.
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $services = json_decode($this->appointment->diagnose->service, true);

        foreach ($services as $serviceId) {
            CheckupProgress::create([
                'appointment_id' => $this->appointment->id,
                'service_id' => $serviceId,
                'status' => 0, // Default: proses
            ]);
        }
    }
}
