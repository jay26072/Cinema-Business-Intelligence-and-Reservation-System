<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f9; font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9; padding:30px 0;">
<tr>
<td align="center">

    <!-- MAIN CONTAINER -->
    <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.05);">

        <!-- HEADER -->
        <tr>
            <td style="background:#4e73df; color:#ffffff; text-align:center; padding:20px;">
                <h2 style="margin:0;">🎬 Cinema System</h2>
                <p style="margin:5px 0 0;">Password Reset Notification</p>
            </td>
        </tr>

        <!-- BODY -->
        <tr>
            <td style="padding:30px; color:#333;">

                <h3 style="margin-top:0;">Hello {{ $theater->theater_name }},</h3>

                <p>
                    Your password has been successfully reset by the administrator.
                </p>

                <!-- LOGIN BOX -->
                <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fc; border-radius:8px; padding:15px; margin:20px 0;">
                    <tr>
                        <td>
                            <p style="margin:5px 0;"><strong>Email:</strong> {{ $theater->theater_email }}</p>
                            <p style="margin:5px 0;"><strong>Password:</strong> {{ $password }}</p>
                        </td>
                    </tr>
                </table>

                <!-- BUTTON -->
                <div style="text-align:center; margin:25px 0;">
                    <a href="{{ url('/login') }}" 
                       style="background:#1cc88a; color:#ffffff; padding:12px 25px; text-decoration:none; border-radius:5px; font-weight:bold;">
                        Login Now
                    </a>
                </div>

                <p style="color:#e74a3b;">
                    ⚠️ For security reasons, please change your password after login.
                </p>

                <p>
                    If you did not request this change, please contact support immediately.
                </p>

            </td>
        </tr>

        <!-- FOOTER -->
        <tr>
            <td style="background:#f1f1f1; text-align:center; padding:15px; font-size:12px; color:#777;">
                © {{ date('Y') }} Cinema System. All rights reserved.
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>