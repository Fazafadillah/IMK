<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'durasi_menit',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'harga' => 'integer',
    ];

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
