<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the cities.
     */
    public function index()
    {
        $cities = City::all();
        
        return response()->json([
            'success' => true,
            'message' => 'List of all cities',
            'data' => $cities
        ]);
    }

    /**
     * Store a newly created city in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:cities',
            'image' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $city = City::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $request->image,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'City created successfully',
            'data' => $city
        ], 201);
    }

    /**
     * Store multiple cities in bulk
     */
    public function bulkStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.name' => 'required|string|max:255|unique:cities,name',
            '*.image' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $cities = [];
        DB::beginTransaction();
        try {
            foreach ($request->all() as $cityData) {
                $cities[] = City::create([
                    'name' => $cityData['name'],
                    'slug' => Str::slug($cityData['name']),
                    'image' => $cityData['image'],
                ]);
            }
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Cities created successfully',
                'data' => $cities
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create cities',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified city.
     */
    public function show($id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json([
                'success' => false,
                'message' => 'City not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $city
        ]);
    }

    /**
     * Update the specified city in storage.
     */
    public function update(Request $request, $id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json([
                'success' => false,
                'message' => 'City not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255|unique:cities,name,'.$id,
            'image' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $dataToUpdate = $request->only(['name', 'image']);
        
        if ($request->has('name')) {
            $dataToUpdate['slug'] = Str::slug($request->name);
        }

        $city->update($dataToUpdate);

        return response()->json([
            'success' => true,
            'message' => 'City updated successfully',
            'data' => $city
        ]);
    }

    /**
     * Update multiple cities in bulk
     */
    public function bulkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.id' => 'required|exists:cities,id',
            '*.name' => 'sometimes|string|max:255|unique:cities,name',
            '*.image' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $updatedCities = [];
        DB::beginTransaction();
        try {
            foreach ($request->all() as $cityData) {
                $city = City::find($cityData['id']);
                $updateData = [];
                
                if (isset($cityData['name'])) {
                    $updateData['name'] = $cityData['name'];
                    $updateData['slug'] = Str::slug($cityData['name']);
                }
                if (isset($cityData['image'])) {
                    $updateData['image'] = $cityData['image'];
                }
                
                $city->update($updateData);
                $updatedCities[] = $city;
            }
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Cities updated successfully',
                'data' => $updatedCities
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cities',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified city from storage.
     */
    public function destroy($id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json([
                'success' => false,
                'message' => 'City not found'
            ], 404);
        }

        // Check if city is used by boarding houses
        if ($city->boardingHouses()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete city because it has associated boarding houses'
            ], 400);
        }

        $city->delete();

        return response()->json([
            'success' => true,
            'message' => 'City deleted successfully'
        ]);
    }

    /**
     * Delete multiple cities in bulk
     */
    public function bulkDestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'exists:cities,id',
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
            // Check if any city has boarding houses
            $citiesWithBoardingHouses = City::whereIn('id', $request->ids)
                ->has('boardingHouses')
                ->count();
                
            if ($citiesWithBoardingHouses > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete cities that have associated boarding houses'
                ], 400);
            }

            City::whereIn('id', $request->ids)->delete();
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Cities deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete cities',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}