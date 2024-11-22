<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'diagnose_id', 'status'];

    /**
     * Relasi ke tabel patients.
     * Satu appointment milik satu patient.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Relasi ke tabel diagnoses.
     * Satu appointment memiliki satu diagnose.
     */
    public function diagnose()
    {
        return $this->belongsTo(Diagnose::class);
    }

    /**
     * Relasi ke tabel checkup_progress.
     * Satu appointment memiliki banyak checkup progress.
     */
    public function checkupProgress()
    {
        return $this->hasMany(CheckupProgress::class);
    }
}
