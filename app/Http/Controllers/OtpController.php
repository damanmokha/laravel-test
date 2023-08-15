<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Damanmokha\OtpVerification\OtpVerification;

class OtpController extends Controller
{
    protected $otp;

    public function __construct()
    {
        $this->otp = new OtpVerification();
    }

    public function sendOtp(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $message = "Your verification otp is: {otp}";
        
        $otpResponse = $this->otp->send($phoneNumber, $message);

        return $otpResponse;
    }

    public function verifyOtp(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $otp = $request->input('otp');
        
        $isVerified = $this->otp->verify($phoneNumber, $otp);

        return ['verified' => $isVerified];
    }
}
