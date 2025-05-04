<?php

namespace App\Services;

use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EmailVerificationService
{
    public function emailVerificationHandler(EmailVerificationRequest $request){
        $user = User::findOrFail($request->id);
            if (!$request->hasValidSignature()) {
                return ['status' => 401, 'message' => 'Invalid Signature.'];
            }
                if (!Auth::check()) {
                    Auth::login($user);
                    if (!$user->hasVerifiedEmail()) {
                        $user->markEmailAsVerified();
                        $user->is_verified = true;
                        $user->save();

                        return true;
                    }
                }
    }

    public function generateVerificationURL($user){
        $verificationURL = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
                [
                    'id' => $user->id,
                    'hash' => sha1($user->email),
                ]
            );
            return $verificationURL;
    }
}
