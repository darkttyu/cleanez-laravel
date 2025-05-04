<?php

namespace App\Services;

use App\Models\User;
use App\Mail\VerificationEmail;
use App\Services\EmailVerificationService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    public function loginHandler(array $validated, EmailVerificationService $emailVerificationService){
        // Fetches User from DB
        $user = User::where('email', $validated['email'])->first();

            // Checks if user exists
            if(!$user) {
                return ['status' => 404, 'message' => 'User not Found.'];
            }

                // Checks if user is verified
                if($user->is_verified == false && $user->email_verified_at == null) {
                    $verificationURL = $emailVerificationService->generateVerificationURL($user);
                    Mail::to($user->email)->send(new VerificationEmail($user->first_name, $verificationURL));
                    return ['status' => 401, 'message' => 'User not Verified. Please check your email for verification link.'];
                }

                    // Checks if credentials are valid
                    if(!$user || !Hash::check($validated['password'], $user->password)) {
                        return ['status' => 401, 'message' => 'Invalid Credentials.'];
                    }

        $user->tokens()->delete();

        $token = $user->createToken('auth_token', ['*'], now()->addMinutes(60))->plainTextToken;
        $user->last_login_at = now();

        $user->save();

        return ['status' => 200, 'message' => 'Login Successful!', 'user' => $user->makeHidden(['password']), 'token' => $token];
    }
}
