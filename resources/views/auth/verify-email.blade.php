<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify Your Email</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
  <div style="text-align: center;">
    <img src="https://drive.google.com/uc?id=19glRWOZo-_BIDAAgFyZ1YeDHoiJy9mhr" alt="Header Image" style="max-width: 100%; height: auto;">
  </div>
  <div style="background-color: #f9f9f9; padding: 20px; border-radius: 0 0 5px 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
    <div style="text-align: center;">
        <span style="font-size: large; font-weight: bold; color: #20063B;">VERIFY YOUR EMAIL 📩</span>
    </div>
    <p>Hello, <span style="font-weight: bold; color: #4CAF50;">{{ $name }}!</span></p>
    <p>Thank you for signing up! Click on the link below to get verified.</p>
    <div style="text-align: center; margin: 30px 0;">
        <a href="{!! $verificationURL !!}"
           style="display: inline-block;
                  background-color: #4CAF50;
                  color: white;
                  font-size: 18px;
                  font-weight: bold;
                  padding: 14px 28px;
                  border-radius: 8px;
                  text-decoration: none;
                  transition: background-color 0.3s ease, transform 0.2s;">
            Verify My Email
        </a>
    </div>

    <br>If you didn't create an account with us, please ignore this email.</p>
    <p>Best regards,<br><span style="font-weight: bold; color: #4CAF50;">CleanEZ Team</span></p>
  </div>
  <div style="text-align: center; margin-top: 10px;">
    <img src="https://drive.google.com/uc?id=1xotvLl_V7k0oQi6B5b9RFE8g4_PIhExX" alt="Header Image" style="max-width: 100%; height: auto;">
  </div>
  <div style="text-align: center; margin-top: 20px; color: #888; font-size: 0.8em;">
    <p>This is an automated message, please do not reply to this email.</p>
  </div>
</body>
</html>
