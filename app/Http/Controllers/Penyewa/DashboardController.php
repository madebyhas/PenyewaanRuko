<?php

namespace App\Http\Controllers\Penyewa;

use App\Models\Ruko;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $rukos = Ruko::where('status', '0')->get();

        $penyewas = Auth::user();

        return view('landing.welcome', compact('rukos', 'penyewas'));
    }
}
