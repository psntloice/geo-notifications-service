<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvanceRequestNotificationController extends Controller
{
    public function send(Request $request)
    {
        // Validate the advance request specific fields
        $data = $request->validate([
'profile_pic' => 'string',
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'salary' => 'required|numeric',
            'request_date' => 'required|date',
            'department' => 'required|string',
            'amount_requested' => 'required|numeric'
        ]);

        // Check which user is calling the service
        // $user = auth()->user();
        $month = $data['month'];
        $year = $data['year'];

        $message = "Request salary advance for the month of $month $year ";
        // Process the reward notification logic
        return response()->json([
            'message' => $message,
            // 'user' => $user,
            'data' => $data
        ]);
    }
}
