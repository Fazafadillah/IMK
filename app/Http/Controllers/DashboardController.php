<?php

namespace App\Http\Controllers;

use App\Models\Available;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const BARBER_JOBS = [
        'Senior Barber',
        'Junior Barber',
        'Barber Trainee',
    ];
    public function index()
    {
        $user = User::first();

        // Semua karyawan (untuk keperluan lain)
        $karyawans = Karyawan::with('available')->get();

        // Hanya barber — tampil di Staff Availability
        $barbers = Karyawan::with('available')
            ->whereIn('profesi', self::BARBER_JOBS)
            ->get();

        $stats = [
            'today_appointments' => 24,
            'staff_available'    => $barbers->filter(fn($k) => $k->getStatus() === 'available')->count(),
            'service_completed'  => 97,
            'customer_review'    => 4.9,
        ];

        $feedbacks = [
            ['nama' => 'Reza Auditore', 'rating' => 3, 'komentar' => '"I like my haircut, Nice"'],
            ['nama' => 'Anton Morger',  'rating' => 3, 'komentar' => '"I\'m becoming more like Ronaldo"'],
            ['nama' => 'Mas Amba',      'rating' => 3, 'komentar' => '"Why am I cool"'],
            ['nama' => 'Pria Oslo',     'rating' => 4, 'komentar' => '"Sometimes I see this is not me"'],
        ];

        return view('dashboard', compact('karyawans', 'barbers', 'stats', 'feedbacks', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'status' => 'required|in:available,busy,off',
        ]);

        $available = $karyawan->available;

        if ($available) {
            $available->update(['status' => $request->status]);
        } else {
            Available::create([
                'karyawan_id' => $karyawan->id,
                'status'      => $request->status,
            ]);
        }

        return response()->json([
            'success' => true,
            'status'  => $request->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
