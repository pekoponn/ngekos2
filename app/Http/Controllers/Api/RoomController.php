<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    // Add room to boarding house
    public function store(Request $request, $boardingHouseId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'room_type' => 'required|string|max:100',
            'square_feet' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'price_per_month' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
            'images' => 'sometimes|array',
            'images.*' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $room = Room::create([
            'boarding_house_id' => $boardingHouseId,
            'name' => $request->name,
            'room_type' => $request->room_type,
            'square_feet' => $request->square_feet,
            'capacity' => $request->capacity,
            'price_per_month' => $request->price_per_month,
            'is_available' => $request->is_available,
        ]);

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                RoomImage::create([
                    'room_id' => $room->id,
                    'image' => $image
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Room added successfully',
            'data' => $room->load('images')
        ], 201);
    }

    // Update room
    public function update(Request $request, $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'room_type' => 'sometimes|string|max:100',
            'square_feet' => 'sometimes|numeric|min:0',
            'capacity' => 'sometimes|integer|min:1',
            'price_per_month' => 'sometimes|numeric|min:0',
            'is_available' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $room->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Room updated successfully',
            'data' => $room
        ]);
    }

    // Delete room
    public function destroy($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }

        $room->delete();

        return response()->json([
            'success' => true,
            'message' => 'Room deleted successfully'
        ]);
    }
}