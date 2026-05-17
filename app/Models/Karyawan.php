<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_handphone',
        'profesi',
        'foto',
    ];

    public function available()
    {
        return $this->hasOne(Available::class);
    }

    public function getStatus(): string
    {
        return $this->available ? $this->available->status : 'off';
    }

    // Backward compat — masih dipakai di beberapa tempat
    public function isAvailable(): bool
    {
        return $this->getStatus() === 'available';
    }
}
