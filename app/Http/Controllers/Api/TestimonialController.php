<?php
// ================================
// TestimonialController.php
// ================================

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $testimonials = Testimonial::with('boardingHouse')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Testimonials retrieved successfully',
            'data' => $testimonials
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'boarding_house_id' => 'required|exists:boarding_houses,id',
                'name' => 'required|string|max:255',
                'rating' => 'required|integer|min:1|max:5',
                'photo' => 'nullable|string',
            ]);

            $testimonial = Testimonial::create($validated);
            $testimonial->load('boardingHouse');

            return response()->json([
                'success' => true,
                'message' => 'Testimonial created successfully',
                'data' => $testimonial
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $testimonial = Testimonial::with('boardingHouse')->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Testimonial retrieved successfully',
                'data' => $testimonial
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimonial not found'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $testimonial = Testimonial::findOrFail($id);

            $validated = $request->validate([
                'boarding_house_id' => 'sometimes|required|exists:boarding_houses,id',
                'name' => 'sometimes|required|string|max:255',
                'rating' => 'sometimes|required|integer|min:1|max:5',
                'photo' => 'nullable|string',
            ]);

            $testimonial->update($validated);
            $testimonial->load('boardingHouse');

            return response()->json([
                'success' => true,
                'message' => 'Testimonial updated successfully',
                'data' => $testimonial
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimonial not found'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Testimonial deleted successfully'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Testimonial not found'
            ], 404);
        }
    }
}