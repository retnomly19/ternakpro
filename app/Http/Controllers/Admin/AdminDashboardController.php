<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total user login
        $totalUsers = User::count();

        // User login hari ini
        $todayUsers = User::whereDate('last_login_at', Carbon::today())->count();

        // Ambil 7 hari terakhir
        $rawDates = collect(range(0, 6))->map(fn($i) => Carbon::today()->subDays($i))->reverse();

        // Label grafik (misalnya: "23 Sep")
        $labels = $rawDates->map(fn($d) => $d->format('d M'));

        // Jumlah login per hari
        $logins = $rawDates->map(fn($d) =>
            User::whereDate('last_login_at', $d)->count()
        );

        // Kirim ke view
        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'todayUsers' => $todayUsers,
            'labels' => $labels->values()->all(),
            'logins' => $logins->values()->all()
        ]);
    }
}
