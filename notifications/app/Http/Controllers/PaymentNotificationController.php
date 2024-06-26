<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentNotificationController extends Controller
{
    public function send(Request $request)
    {
        // Validate the payment specific fields
        $data = $request->validate([
            'profile_pic' => 'string',
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'month' => 'required|string',
            'year' => 'required|integer',
            'amount' => 'required|numeric',
            'date' => 'required|date'
        ]);

        // Check which user is calling the service
        // $user = auth()->user();

        $month = $data['month'];
        $year = $data['year'];

        $message = "Payment for for $month $year has been disbursed";

        //if true $ true = true
        //if in (management or admin) $ (not the owner) = view others payments else view yours
        // $user = auth()->user();
        // if (!$user->hasRole(['manager', 'employee'])) {
        //     return response()->json(['error' => 'Forbidden'], 403);
        // }

        // // Check if the user is a manager or the owner of the notification
        // $isManager = $user->hasRole('manager');
        // $isOwner = $user->id == $data['employee_id'];

        // if ($isManager || $isOwner) {
        //     // Process the advance request notification logic
        //     return response()->json([
        //         'message' => 'Advance request notification sent successfully!',
        //         'data' => $data
        //     ]);
        // } else {
        //     return response()->json(['error' => 'Forbidden'], 403);
        // }

        
        //Process the reward notification logic
        return response()->json([
            'message' => $message,
            // 'user' => $user,
            'data' => $data
        ]);
    }
}
