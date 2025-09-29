<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\CustomerOtpMail;


class AuthController extends Controller
{
    /**
     * Handle customer login & send OTP.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ✅ Just validate credentials — don't log in yet
        if (!Auth::guard('customer')->validate($credentials)) {
            return back()->withInput()->with('error', 'Invalid login credentials.');
        }

        // ✅ Fetch user and role check
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || $user->role !== 'Customer') {
            return back()->withInput()->with('error', 'Access denied: Only customers can log in.');
        }

        // ✅ Generate OTP
        $otp = rand(100000, 999999);

        // ✅ Store OTP in session
        session([
            'otp_user_id' => $user->id,
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        // ✅ Log & send OTP
        Log::info("OTP for {$user->email}: {$otp}");

        // Mail::raw("Your OTP is: $otp", function ($message) use ($user) {
        //     $message->to($user->email)->subject('Your OTP Code');
        // });

        Mail::to($user->email)->send(new CustomerOtpMail($otp));

        // ✅ Redirect to OTP input form
        return redirect()->route('otp.verify');
    }

    /**
     * Show OTP verification form.
     */
    public function showOtpForm()
    {
        return view('auth.verify-otp'); // Make sure this Blade file exists
    }

    /**
     * Handle OTP verification & login.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $expectedOtp = session('otp_code');
        $userId = session('otp_user_id');
        $expiresAt = session('otp_expires_at');

        // Session check
        if (!$userId || !$expectedOtp || now()->gt($expiresAt)) {
            session()->forget(['otp_code', 'otp_user_id', 'otp_expires_at']);
            return redirect()->route('login')->with('error', 'OTP session expired. Please login again.');
        }

        // Invalid OTP
        if ($request->otp != $expectedOtp) {
            return back()->with('error', 'Invalid OTP.');
        }

        // ✅ OTP is correct → log user in
        $user = User::find($userId);
        Auth::guard('customer')->login($user);
        $request->session()->regenerate(); // Prevent session fixation

        // Clear OTP from session
        session()->forget(['otp_code', 'otp_user_id', 'otp_expires_at']);

        return redirect()->intended('/home'); // Authenticated area
    }

    /**
     * Log the user out of the session.
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout(); // Logout from customer guard

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Logged out successfully.');
    }
}