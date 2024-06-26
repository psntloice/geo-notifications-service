<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisbursementNotificationController extends Controller
{
    public function send(Request $request)
    {
        // Validate the payment specific fields
        $data = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
            'date' => 'required|date'
        ]);

        // Check which user is calling the service
        // $user = auth()->user();

        $month = $data['month'];
        $year = $data['year'];

        $message = "Disbursment date for $month $year open";
        // Process the reward notification logic
        return response()->json([
            'message' => $message,
            // 'user' => $user,
            'data' => $data
        ]);
    }
}
