<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PaymentNotificationController extends Controller
{

    public function send(Request $request)
    {

        try {
            // Validate the reward specific fields
            $data = $request->validate([
                'email' => 'required|email',
                'profile_pic' => 'string',
                'first_name' => 'required|string',
                'second_name' => 'required|string',
                'month' => 'required|string',
                'year' => 'required|integer',
                'amount' => 'required|numeric',
                // 'date' => 'required|date'
            ]);

            $month = $data['month'];
            $year = $data['year'];
            $ownersemail = $data['email'];
            $message = "Payment for for $month $year has been disbursed";


            // Access the email and role from the request attributes
            $email = $request->get('email');
            $role = $request->get('role');

            if (($role == 'admin' || $role == 'manager') && $email != $ownersemail) {
                // Process the advance request notification logic
                return response()->json([
                    'message' => $message,
                    'data' => $data
                ]);
            } else if ($email == $ownersemail) {
                // Return unauthorized response if conditions are not met
                return response()->json([
                    'message' => $message,
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

      
        // Check which user is calling the service
        // $user = auth()->user();


        //if true $ true = true
        //if in (management or admin) $ (not the owner) = view others payments else view yours
        // $user = auth()->user();
        // if (!$user->hasRole(['manager', 'employee'])) {
        //     return response()->json(['error' => 'Forbidden'], 403);
        // }


    }
}
