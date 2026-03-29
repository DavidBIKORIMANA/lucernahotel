<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background:#f4f6fa;font-family:'Segoe UI',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6fa;padding:40px 20px;">
<tr><td align="center">
<table width="520" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:4px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.06);">
    {{-- Header --}}
    <tr><td style="background:linear-gradient(135deg,#0c4da2 0%,#0c2340 100%);padding:32px 40px;text-align:center;">
        <div style="font-family:Georgia,serif;font-size:24px;color:#ffffff;font-weight:400;">{{ config('app.name') }}</div>
        <div style="font-size:12px;color:rgba(255,255,255,.5);letter-spacing:2px;margin-top:4px;">★★★</div>
    </td></tr>

    {{-- Body --}}
    <tr><td style="padding:40px;">
        <p style="font-size:15px;color:#4a5568;margin:0 0 8px;">Hello <strong style="color:#0c2340;">{{ $userName }}</strong>,</p>

        @if($purpose === 'reset')
        <p style="font-size:15px;color:#4a5568;margin:0 0 24px;line-height:1.6;">
            We received a request to reset your password. Use the verification code below to proceed. This code expires in <strong>10 minutes</strong>.
        </p>
        @else
        <p style="font-size:15px;color:#4a5568;margin:0 0 24px;line-height:1.6;">
            Thank you for registering. Please use the verification code below to verify your email address. This code expires in <strong>10 minutes</strong>.
        </p>
        @endif

        {{-- OTP Box --}}
        <div style="text-align:center;margin:28px 0;">
            <div style="display:inline-block;background:#f0f5ff;border:2px dashed #0c4da2;border-radius:8px;padding:18px 40px;">
                <span style="font-family:'Courier New',monospace;font-size:36px;font-weight:700;letter-spacing:10px;color:#0c4da2;">{{ $otp }}</span>
            </div>
        </div>

        <p style="font-size:13px;color:#8898aa;margin:24px 0 0;line-height:1.6;">
            If you did not {{ $purpose === 'reset' ? 'request a password reset' : 'create an account' }}, you can safely ignore this email.
        </p>
    </td></tr>

    {{-- Footer --}}
    <tr><td style="background:#f8f9fc;padding:20px 40px;border-top:1px solid #edf0f4;text-align:center;">
        <p style="font-size:12px;color:#8898aa;margin:0;">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </td></tr>
</table>
</td></tr>
</table>
</body>
</html>
