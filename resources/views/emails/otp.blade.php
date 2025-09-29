<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            background-color: #ffffff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            background-color: #e8f5e9;
            padding: 15px 25px;
            border-radius: 6px;
            display: inline-block;
            letter-spacing: 5px;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .footer {
            font-size: 13px;
            color: #aaa;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>OTP Verification</h1>
        <p>Hello,</p>
        <p>Your One-Time Password (OTP) is:</p>
        <div class="otp-code">{{ $otp }}</div>
        <p>This code will expire in <strong>5 minutes</strong>.</p>
        <p>If you did not request this, please ignore this message.</p>
        <div class="footer">
            &copy; {{ date('Y') }} Paws and Perch. All rights reserved.
        </div>
    </div>
</body>
</html>
