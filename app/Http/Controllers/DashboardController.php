<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * แสดงหน้าแดชบอร์ดหลัก
     */
    public function index(): View
    {
        $userCount = User::count();
        $recentUsers = User::latest()->take(5)->get();
        $currentUser = Auth::user();

        return view('dashboard', compact('userCount', 'recentUsers', 'currentUser'));
    }
}
