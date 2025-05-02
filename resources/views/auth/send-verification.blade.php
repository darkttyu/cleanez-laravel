<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: linear-gradient(to bottom right, #ebf8ff, #90cdf4); height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div style="background-color: #ffffff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); text-align: center; max-width: 400px; width: 100%;">
        <h1 style="font-size: 24px; font-weight: bold; color: #2d3748; margin-bottom: 16px;">Verify Your Email Address</h1>
        <p style="color: #4a5568; margin-bottom: 24px;">Click the button below to resend the verification email.</p>

        @if (session('status') === 'verification-link-sent')
            <div style="background-color: #c6f6d5; color: #22543d; padding: 12px; border-radius: 8px; margin-bottom: 16px;">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" style="background-color: #3182ce; color: white; border: none; padding: 12px 24px; font-size: 16px; border-radius: 8px; cursor: pointer;">
                Resend Verification Email
            </button>
        </form>
    </div>

</body>
</html>
