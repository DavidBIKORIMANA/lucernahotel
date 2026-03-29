<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OtpVerificationController extends Controller
{
    /**
     * Show the OTP verification form.
     */
    public function show(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->email_verified_at) {
            return redirect()->route('dashboard');
        }

        return view('auth.verify-otp');
    }

    /**
     * Send (or resend) an OTP to the authenticated user.
     */
    public function send(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->email_verified_at) {
            return redirect()->route('dashboard');
        }

        $otp = random_int(100000, 999999);
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail((string)$otp, 'verify', $user->name));

        return back()->with('status', 'A new verification code has been sent to your email.');
    }

    /**
     * Verify the OTP submitted by the user.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();

        if ($user->email_verified_at) {
            return redirect()->route('dashboard');
        }

        if (!$user->otp || $user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'The verification code is incorrect.']);
        }

        if ($user->otp_expires_at && now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'The verification code has expired. Please request a new one.']);
        }

        $user->update([
            'email_verified_at' => now(),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        $redirect = session('url.intended');

        return redirect($redirect ?? route('dashboard'))->with([
            'message' => 'Email verified successfully!',
            'alert-type' => 'success',
        ]);
    }
}
