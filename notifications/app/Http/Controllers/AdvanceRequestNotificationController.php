<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AdvanceRequestNotificationController extends Controller
{
    public function send(Request $request)
    {
      
     
        try {
           // Validate the advance request specific fields
        $data = $request->validate([
            'email' => 'required|email',
            'profile_pic' => 'string',
                        'first_name' => 'required|string',
                        'second_name' => 'required|string',
                        'salary' => 'required|numeric',
                        'request_date' => 'required|date',
                        'department' => 'required|string',
                        'month' => 'required|string',
                'year' => 'required|integer',
                        'amount_requested' => 'required|numeric'
                    ]);
            
                    // Check which user is calling the service
                    // $user = auth()->user();
                    $month = $data['month'];
                    $year = $data['year'];
                    $requestemail = $data['email'];

                    $supermessage = "Request salary advance for the month of $month $year ";
                    $ownermessage = "Your request for salary advance for the month of $month $year has been sent";

 // Access the email and role from the request attributes
 $ownersemail = $request->get('email');
 $role = $request->get('role');

 if ($requestemail == $ownersemail) {
    // Return unauthorized response if conditions are not met
    return response()->json([
        'message' => $ownermessage,
        'data' => $data
    ]);
} else if (($role == 'admin' || $role == 'manager' || $role == 'tech_lead') && ($requestemail != $ownersemail)) {
    // Process the advance request notification logic
    return response()->json([
        'message' => $supermessage,
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
