<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
{
    if (Auth::user()->role !== 'admin') {
        abort(403, 'Akses ditolak');
    }

    // Ambil semua user
    $totalUsers = User::count();

    // Hitung user login hari ini
    $todayUsers = User::whereDate('last_login_at', now()->toDateString())->count();

    // Ambil data login harian dari kolom last_login_at
    $logins = User::selectRaw('DATE(last_login_at) as tanggal, COUNT(*) as total')
        ->whereNotNull('last_login_at')
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'asc')
        ->get();

    $dates = $logins->pluck('tanggal')->map(function($d) {
        return date('d M', strtotime($d));
    });

    $totals = $logins->pluck('total');

    return view('admin.dashboard', [
        'totalUsers' => $totalUsers,
        'todayUsers' => $todayUsers,
        'dates' => $dates,
        'logins' => $totals,
    ]);
}
}
