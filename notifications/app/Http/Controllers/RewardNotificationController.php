<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RewardNotificationController extends Controller
{
    public function send(Request $request)
    {
        // Validate the reward specific fields
        $data = $request->validate([
            'profile_pic' => 'string',
            'award_desc' => 'required|string',
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'reward_desc' => 'required|string',
            'month1' => 'required|string',
            'month2' => 'required|string',
            'year' => 'required|integer',
            'amount' => 'required|numeric',
            'date' => 'required|date'
        ]);

        // Check which user is calling the service
        // $user = auth()->user();
 $awardDesc = $data['award_desc'];
 $month1 = $data['month1'];
 $month2 = $data['month2'];
 $year = $data['year'];
 $awardDesc = $data['award_desc'];

        $message = "Has been awarded $awardDesc of the period $month1-$month2 $year";
        // Process the reward notification logic
        return response()->json([
            'message' => $message,
            // 'user' => $user,
            'data' => $data
        ]);
    }
}
