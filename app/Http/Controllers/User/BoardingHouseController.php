<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BoardingHouse;

class BoardingHouseController extends Controller
{
    public function index()
    {
        $boardingHouses = BoardingHouse::with('city')->paginate(5);
        return view('dashboard', compact('boardingHouses'));
    }

    public function show($slug)
    {
        $house = BoardingHouse::where('slug', $slug)->with('city')->firstOrFail();
        return view('boarding-house.show', compact('house'));
    }
}
