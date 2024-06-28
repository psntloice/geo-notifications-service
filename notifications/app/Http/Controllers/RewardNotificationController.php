<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RewardNotificationController extends Controller
{
    public function send(Request $request)
    {
        try {
            // Validate the reward specific fields
            $data = $request->validate([
                'email' => 'required|email',
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
            $awardDesc = $data['award_desc'];
            $month1 = $data['month1'];
            $month2 = $data['month2'];
            $year = $data['year'];
            $awardDesc = $data['award_desc'];
            $requestemail = $data['email'];


            $supermessage = "Has been awarded $awardDesc of the period $month1-$month2 $year";
            $ownermessage = "You have been awarded $awardDesc of the period $month1-$month2 $year";


            // Access the email and role from the request attributes
            $ownersemail = $request->get('email');
            $role = $request->get('role');

            if (($role == 'admin' || $role == 'manager' ) && ($requestemail != $ownersemail)) {
                // Process the advance request notification logic
                return response()->json([
                    'message' => $supermessage,
                    'data' => $data
                ]);
            } else if ($requestemail == $ownersemail) {
                // Return unauthorized response if conditions are not met
                return response()->json([
                    'message' => $ownermessage,
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
