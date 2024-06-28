<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class DisbursementNotificationController extends Controller
{
    public function send(Request $request)
    {

        
        try {
            
        // Validate the payment specific fields
        $data = $request->validate([
            'email' => 'required|email',
            'month' => 'required|string',
            'year' => 'required|integer',
            'date' => 'required|date'
        ]);

        // Check which user is calling the service
        // $user = auth()->user();

        $month = $data['month'];
        $year = $data['year'];
        $requestemail = $data['email'];

        $message = "Disbursment date for $month $year open";
        // Process the reward notification logic
        $ownersemail = $request->get('email');
            
            if ($requestemail == $ownersemail) {
                // Return unauthorized response if conditions are not met
                return response()->json([
                    'message' => $message,
                    // 'user' => $user,
                    'data' => $data
                ]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } catch (ValidationException $e) {
            // Log validation errors
            Log::error('Validation Error', ['errors' => $e->errors()]);
            return response()->json(['error' => 'Validation failed', 'errors' => $e->errors()], 422);
        }

    }
}
