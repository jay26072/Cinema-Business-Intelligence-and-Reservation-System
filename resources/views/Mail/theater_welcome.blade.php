<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome</title>
</head>

<body style="font-family:Arial;background:#f4f4f4;padding:20px;">

<div style="max-width:600px;margin:auto;background:#fff;border-radius:10px;padding:20px">

    <h2 style="color:#4CAF50;">🎬 Welcome {{ $theater->theater_name }}</h2>

    <p>Your theater has been successfully registered on our platform.</p>

    <div style="background:#f9f9f9;padding:15px;border-radius:8px;margin:15px 0">
        <p><strong>Email:</strong> {{ $theater->theater_email }}</p>
        <p><strong>Password:</strong> {{ $password }}</p>
    </div>

    <p>You can now login and manage:</p>
    <ul>
        <li>🎟 Movie Shows</li>
        <li>💺 Seat Booking</li>
        <li>📊 Reports & Analytics</li>
    </ul>

    <a href="{{ url('/theater/login') }}"
       style="display:inline-block;background:#4CAF50;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;">
       Login Now
    </a>

    <p style="margin-top:20px;">Thank you,<br>🎬 Cinema Team</p>

</div>

</body>
</html>