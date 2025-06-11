<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SMSController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'country_code' => 'required|string',
        ]);

        $fullNumber = $request->country_code . $request->phone_number;
        $verificationCode = rand(100000, 999999);

        // Store code temporarily (5 minutes)
        Cache::put('sms_code_' . $fullNumber, $verificationCode, now()->addMinutes(5));

        // Send via Twilio
        try {
            $sid = config('services.twilio.sid');
            $token = config('services.twilio.token');
            $from = config('services.twilio.from');
            $client = new Client($sid, $token);

            $client->messages->create($fullNumber, [
                'from' => $from,
                'body' => "Your verification code is: {$verificationCode}"
            ]);

            return response()->json(['message' => 'Code sent successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send SMS.'], 500);
        }
    }
}