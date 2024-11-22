<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnose extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'service'];

    /**
     * Relasi ke tabel appointments.
     * Satu diagnose dapat digunakan oleh banyak appointments.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
