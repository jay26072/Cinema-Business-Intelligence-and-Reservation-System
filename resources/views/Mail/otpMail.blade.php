<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;margin-top:40px;border-radius:8px;overflow:hidden;box-shadow:0 5px 15px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#111827;color:#fff;padding:20px;text-align:center;">
                            <h2 style="margin:0;">🎬 Movie Booking</h2>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px;text-align:center;">

                            <h3 style="margin-bottom:10px;">Password Reset OTP</h3>
                            <p style="color:#555;">Use the OTP below to reset your password</p>

                            <!-- OTP BOX -->
                            <div style="margin:30px 0;">
                                <span style="display:inline-block;background:#f3f4f6;padding:15px 30px;font-size:28px;letter-spacing:6px;font-weight:bold;border-radius:6px;color:#111;">
                                    {{ $otp }}
                                </span>
                            </div>

                            <p style="color:#777;font-size:14px;">
                                This OTP is valid for <strong>5 minutes</strong>.
                            </p>

                            <p style="color:#999;font-size:13px;margin-top:20px;">
                                If you didn’t request this, you can safely ignore this email.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb;padding:15px;text-align:center;font-size:12px;color:#888;">
                            © {{ date('Y') }} Movie Booking System. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>