<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $rumahSakits = RumahSakit::all();
    $pasiens = Pasien::all();

    return view('dashboard', compact('rumahSakits', 'pasiens'));
}
}
