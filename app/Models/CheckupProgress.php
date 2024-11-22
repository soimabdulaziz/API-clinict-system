<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckupProgress extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'service_id', 'status'];

    /**
     * Relasi ke tabel appointments.
     * Satu checkup progress milik satu appointment.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
