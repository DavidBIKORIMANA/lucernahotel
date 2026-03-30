<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Message Received</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:'Segoe UI',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:40px 0;">
<tr><td align="center">
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <!-- Header -->
    <tr>
        <td style="background:#0c1120;padding:32px 40px;text-align:center;">
            <h1 style="margin:0;color:#c8a45a;font-size:22px;font-weight:600;letter-spacing:1px;">LUCERNA KABGAYI HOTEL</h1>
        </td>
    </tr>
    <!-- Body -->
    <tr>
        <td style="padding:40px;">
            <h2 style="margin:0 0 16px;color:#0c1120;font-size:20px;">Thank You, {{ $contact->name }}!</h2>
            <p style="margin:0 0 20px;color:#555;font-size:15px;line-height:1.7;">
                We have received your message and appreciate you reaching out to us. A member of our team will respond within 24 hours.
            </p>

            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f7f4;border-radius:6px;padding:20px;margin:24px 0;">
            <tr><td style="padding:20px;">
                <p style="margin:0 0 8px;color:#888;font-size:12px;text-transform:uppercase;letter-spacing:1px;">Your Message Summary</p>
                <p style="margin:0 0 4px;color:#333;font-size:14px;"><strong>Subject:</strong> {{ $contact->subject }}</p>
                <p style="margin:0;color:#555;font-size:14px;line-height:1.6;">{{ $contact->message }}</p>
            </td></tr>
            </table>

            <p style="margin:24px 0 0;color:#555;font-size:14px;line-height:1.6;">
                If your matter is urgent, please call us directly at <a href="tel:+250794191115" style="color:#0057b7;text-decoration:none;">+250 794 191 115</a>.
            </p>
        </td>
    </tr>
    <!-- Footer -->
    <tr>
        <td style="background:#f8f7f4;padding:24px 40px;text-align:center;border-top:1px solid #eee;">
            <p style="margin:0 0 4px;color:#888;font-size:12px;">Lucerna Kabgayi Hotel &middot; Muhanga, Kabgayi, Rwanda</p>
            <p style="margin:0;color:#aaa;font-size:11px;">&copy; {{ date('Y') }} Lucerna Kabgayi Hotel. All rights reserved.</p>
        </td>
    </tr>
</table>
</td></tr>
</table>
</body>
</html>
