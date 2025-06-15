<?php
// ================================
// TransactionController.php
// ================================

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index(): JsonResponse
    {
        $transactions = Transaction::with(['boardingHouse', 'room'])->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Transactions retrieved successfully',
            'data' => $transactions
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string|max:255|unique:transactions,code',
                'boarding_house_id' => 'required|exists:boarding_houses,id',
                'room_id' => 'required|exists:rooms,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'payment_method' => 'required|string|max:255',
                'payment_status' => 'required|string|max:255',
                'start_date' => 'required|date',
                'duration' => 'required|integer|min:1',
                'total_amount' => 'required|numeric|min:0',
                'transaction_date' => 'required|date',
            ]);

            $transaction = Transaction::create($validated);
            $transaction->load(['boardingHouse', 'room']);

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully',
                'data' => $transaction
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
            $transaction = Transaction::with(['boardingHouse', 'room'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Transaction retrieved successfully',
                'data' => $transaction
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $transaction = Transaction::findOrFail($id);

            $validated = $request->validate([
                'code' => 'sometimes|required|string|max:255|unique:transactions,code,' . $id,
                'boarding_house_id' => 'sometimes|required|exists:boarding_houses,id',
                'room_id' => 'sometimes|required|exists:rooms,id',
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email',
                'phone' => 'sometimes|required|string|max:20',
                'payment_method' => 'sometimes|required|string|max:255',
                'payment_status' => 'sometimes|required|string|max:255',
                'start_date' => 'sometimes|required|date',
                'duration' => 'sometimes|required|integer|min:1',
                'total_amount' => 'sometimes|required|numeric|min:0',
                'transaction_date' => 'sometimes|required|date',
            ]);

            $transaction->update($validated);
            $transaction->load(['boardingHouse', 'room']);

            return response()->json([
                'success' => true,
                'message' => 'Transaction updated successfully',
                'data' => $transaction
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
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
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            return response()->json([
                'success' => true,
                'message' => 'Transaction deleted successfully'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }
    }
}