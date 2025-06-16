<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;

class DashboardController extends Controller
{
    public function index()
    {
        $boardingHouses = BoardingHouse::latest()->take(5)->get();
        return view('dashboard', compact('boardingHouses'));
    }
}
