<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Ruko;
use App\Models\Admin;
use App\Models\Penyewa;
use App\Models\Sewaruko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = Admin::all()->count();
        
        $penyewa = Penyewa::all()->count();

        $ruko = Ruko::all()->count();
        
        $sewaruko = Sewaruko::all()->count();

        return view('admin.dashboard', compact('admin', 'penyewa', 'ruko', 'sewaruko'));
    }
}
