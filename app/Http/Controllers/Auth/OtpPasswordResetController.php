<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class OtpPasswordResetController extends Controller
{
    /**
     * Show the forgot-password form (enter email).
     */
    public function showForgotForm(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Send an OTP to the user's email for password reset.
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'No account found with that email address.']);
        }

        $otp = random_int(100000, 999999);
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail((string)$otp, 'reset', $user->name));

        session(['password_reset_email' => $request->email]);

        return redirect()->route('password.otp.verify')->with('status', 'A verification code has been sent to your email.');
    }

    /**
     * Show the OTP verification form for password reset.
     */
    public function showVerifyForm(): View|RedirectResponse
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-verify-otp');
    }

    /**
     * Verify the OTP and show the new password form.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $email = session('password_reset_email');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired. Please try again.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user || !$user->otp || $user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'The verification code is incorrect.']);
        }

        if ($user->otp_expires_at && now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'The verification code has expired. Please request a new one.']);
        }

        session(['password_reset_verified' => true]);

        return redirect()->route('password.otp.new');
    }

    /**
     * Show the new password form.
     */
    public function showNewPasswordForm(): View|RedirectResponse
    {
        if (!session('password_reset_email') || !session('password_reset_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-new-password');
    }

    /**
     * Store the new password.
     */
    public function storeNewPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = session('password_reset_email');
        if (!$email || !session('password_reset_verified')) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired. Please try again.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'User not found.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        session()->forget(['password_reset_email', 'password_reset_verified']);

        return redirect()->route('login')->with([
            'message' => 'Password reset successfully! Please sign in.',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Resend reset OTP.
     */
    public function resendOtp(): RedirectResponse
    {
        $email = session('password_reset_email');
        if (!$email) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('password.request');
        }

        $otp = random_int(100000, 999999);
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail((string)$otp, 'reset', $user->name));

        return back()->with('status', 'A new verification code has been sent.');
    }
}
