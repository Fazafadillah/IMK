<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Available extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'status', // 'available' | 'busy' | 'off'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            'available' => 'AVAILABLE',
            'busy'      => 'BUSY',
            'off'       => 'OFF',
            default     => 'UNKNOWN',
        };
    }

    public static function statusColor(string $status): string
    {
        return match ($status) {
            'available' => '#2d6a4f',
            'busy'      => '#dc3545',
            'off'       => '#4b4b4b',
            default     => '#6b7280',
        };
    }
}
