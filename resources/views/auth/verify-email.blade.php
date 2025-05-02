<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>
<body style="margin: 0; padding: 0; background-color: #ebf8ff; font-family: Arial, sans-serif;">

    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="padding: 40px; text-align: center;">
                            <h1 style="font-size: 24px; font-weight: bold; color: #2d3748; margin: 0 0 16px;">Verify Your Email Address</h1>
                            <p style="color: #4a5568; font-size: 16px; margin: 0 0 24px;">
                                Click the button below to verify your email and activate your account.
                            </p>

                            <!-- Replace with actual verification link -->
                            <a href="{{ $verificationUrl ?? url('/email/verify') }}" 
                               style="display: inline-block; padding: 12px 24px; background-color: #3182ce; color: #ffffff; text-decoration: none; border-radius: 6px; font-size: 16px;">
                                Verify Email
                            </a>

                            <p style="color: #718096; font-size: 14px; margin-top: 30px;">
                                If you didn’t create an account, no further action is required.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
