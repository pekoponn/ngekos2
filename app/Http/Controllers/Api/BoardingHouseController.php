<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BoardingHouse;
use App\Models\Room;
use App\Models\Bonus;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BoardingHouseController extends Controller
{
    // Get all boarding houses
    public function index()
    {
        $boardingHouses = BoardingHouse::with(['city', 'category', 'rooms', 'bonuses'])->get();
        
        return response()->json([
            'success' => true,
            'message' => 'List of all boarding houses',
            'data' => $boardingHouses
        ]);
    }

    // Create new boarding house
    public function storeMultiple(Request $request)
{
    $validator = Validator::make($request->all(), [
        'boarding_houses' => 'required|array|min:1',
        'boarding_houses.*.name' => 'required|string|max:255',
        'boarding_houses.*.thumbnail' => 'required|string',
        'boarding_houses.*.city_id' => 'required|exists:cities,id',
        'boarding_houses.*.category_id' => 'required|exists:categories,id',
        'boarding_houses.*.description' => 'required|string',
        'boarding_houses.*.price' => 'required|numeric|min:0',
        'boarding_houses.*.address' => 'required|string|max:500',
        'boarding_houses.*.rooms' => 'required|array|min:1',
        'boarding_houses.*.rooms.*.name' => 'required|string|max:255',
        'boarding_houses.*.rooms.*.room_type' => 'required|string|max:100',
        'boarding_houses.*.rooms.*.square_feet' => 'required|numeric|min:0',
        'boarding_houses.*.rooms.*.capacity' => 'required|integer|min:1',
        'boarding_houses.*.rooms.*.price_per_month' => 'required|numeric|min:0',
        'boarding_houses.*.rooms.*.is_available' => 'required|boolean',
        'boarding_houses.*.bonuses' => 'sometimes|array',
        'boarding_houses.*.bonuses.*.image' => 'sometimes|string|max:255',
        'boarding_houses.*.bonuses.*.name' => 'required_with:boarding_houses.*.bonuses|string|max:255',
        'boarding_houses.*.bonuses.*.description' => 'required_with:boarding_houses.*.bonuses|string|max:500',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);
    }

    DB::beginTransaction();

    try {
        $savedBoardingHouses = [];

        foreach ($request->boarding_houses as $bhData) {
            $boardingHouse = BoardingHouse::create([
                'name' => $bhData['name'],
                'slug' => Str::slug($bhData['name']),
                'thumbnail' => $bhData['thumbnail'],
                'city_id' => $bhData['city_id'],
                'category_id' => $bhData['category_id'],
                'description' => $bhData['description'],
                'price' => $bhData['price'],
                'address' => $bhData['address'],
            ]);

            // Tambahkan rooms
            foreach ($bhData['rooms'] as $roomData) {
                $room = $boardingHouse->rooms()->create($roomData);
                if (isset($roomData['images'])) {
                    foreach ($roomData['images'] as $image) {
                        $room->images()->create(['image' => $image]);
                    }
                }
            }

            // Tambahkan bonuses jika ada
            if (isset($bhData['bonuses'])) {
                $boardingHouse->bonuses()->createMany($bhData['bonuses']);
            }

            $savedBoardingHouses[] = $boardingHouse->load(['city', 'category', 'rooms.images', 'bonuses']);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'All boarding houses created successfully',
            'data' => $savedBoardingHouses
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Failed to create boarding houses',
            'error' => $e->getMessage()
        ], 500);
     }
    }
}