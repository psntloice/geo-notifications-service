<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Notifications microservice is up and running!'
        ]);
    }
    // Method to handle reward notifications
    public function reward(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'user_id' => 'required|integer',
            'reward_details' => 'required|string',
        ]);

        // Process the notification logic (e.g., store in database, send email, etc.)
        // For this example, we're just returning the data as a response
        return response()->json([
            'message' => 'Reward notification sent successfully!',
            'data' => $data
        ]);
    }

    // Method to handle disbursement notifications
    public function disbursement(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'user_id' => 'required|integer',
            'disbursement_details' => 'required|string',
        ]);

        // Process the notification logic
        return response()->json([
            'message' => 'Disbursement notification sent successfully!',
            'data' => $data
        ]);
    }

    // Method to handle advance requirement notifications
    public function advanceRequirement(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'user_id' => 'required|integer',
            'requirement_details' => 'required|string',
        ]);

        // Process the notification logic
        return response()->json([
            'message' => 'Advance requirement notification sent successfully!',
            'data' => $data
        ]);
    }
}
