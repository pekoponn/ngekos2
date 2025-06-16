<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BoardingHouse;
use App\Models\City;
use App\Models\Category;
use Illuminate\Http\Request;

class BoardingHouseController extends Controller
{
    public function index(Request $request)
    {
        $query = BoardingHouse::with(['city', 'category'])
            ->filter($request->only(['search', 'city', 'category']));

        return view('user.boardinghouses.index', [
            'boardingHouses' => $query->paginate(10),
            'cities' => City::all(),
            'categories' => Category::all(),
        ]);
    }

    public function show($slug)
    {
        $boardingHouse = BoardingHouse::with([
            'city',
            'category',
            'rooms.images',
            'bonuses',
            'testimonials'
        ])->where('slug', $slug)->firstOrFail();

        return view('user.boardinghouses.show', compact('boardingHouse'));
    }
}