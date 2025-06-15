<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BonusController extends Controller
{
    // Add bonus to boarding house
    public function store(Request $request, $boardingHouseId)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'sometimes|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $bonus = Bonus::create([
            'boarding_house_id' => $boardingHouseId,
            'image' => $request->image,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bonus added successfully',
            'data' => $bonus
        ], 201);
    }

    // Update bonus
    public function update(Request $request, $id)
    {
        $bonus = Bonus::find($id);

        if (!$bonus) {
            return response()->json([
                'success' => false,
                'message' => 'Bonus not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'sometimes|string|max:255',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $bonus->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Bonus updated successfully',
            'data' => $bonus
        ]);
    }

    // Delete bonus
    public function destroy($id)
    {
        $bonus = Bonus::find($id);

        if (!$bonus) {
            return response()->json([
                'success' => false,
                'message' => 'Bonus not found'
            ], 404);
        }

        $bonus->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bonus deleted successfully'
        ]);
    }
}