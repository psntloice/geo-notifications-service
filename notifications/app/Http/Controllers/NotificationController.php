<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        // return response()->json([
        //     'message' => 'Reward notification sent successfully!',
        // ]);
        $user = Auth::user();

        // if ($user->role === 'staff' || $user->role === 'tech_lead') {
        //     $payments = "you did it";
        // } else {
        //     $payments = "you failed";
        // }
        // $jwtPayload = $request->get('jwt_payload');
        // $email = $request->get('email');
        // $role = $request->get('role');
return "yooh";
        // return response()->json([
        //     'message' => 'Request successful',
        //     'payload' => $jwtPayload,
        // ]);
        // return response()->json( $payments);
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
