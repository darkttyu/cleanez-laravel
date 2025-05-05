<?php

namespace App\Http\Controllers;

use App\Services\EmailVerificationService;
use App\Services\AuthService;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\EmailVerificationRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

class AuthController extends Controller
{
    /**
     * User Authentication Main Methods
     */
    public function signup(SignupRequest $request, EmailVerificationService $emailVerificationService) {
        $validated = $request->validated();
        $user = User::create($validated);

        $verificationURL = $emailVerificationService->generateVerificationURL($user);
        Mail::to($user->email)->send(new VerificationEmail($user->first_name, $verificationURL));

        return response()->json([
            'message' => 'User Created Successfully! Verification email sent.',
            'user' => $user->makeHidden(['password', 'remember_token']),
        ], 200);
    }

    public function verify(EmailVerificationRequest $emailVerificationRequest, EmailVerificationService $emailVerificationService){
        $request = $emailVerificationService->emailVerificationHandler($emailVerificationRequest);

        if(!$request) {
            return response()->json([
                'status' => $request['status'],
                'message' => $request['message'],
            ]);
        } else {
            return redirect()->route('email-verified')->with('message', 'Email Verified Successfully!');
        }
    }

    public function login(LoginRequest $request, AuthService $authService, EmailVerificationService $emailVerificationService) {

        $validated = $request->validated();

        $result = $authService->loginHandler($validated, $emailVerificationService);

            // if($result['status'] == 200) {
            //     return response()->json([
            //         'status' => $result['status'],
            //         'message' => $result['message'],
            //         'user' => $result['user'],
            //         'token' => $result['token']
            //     ]);
            // } else {
            //     return response()->json([
            //         'status' => $result['status'],
            //         'message' => $result['message'],
            //     ]);
            // }

            return response()->json([
                'status' => $result['status'],
                'message' => $result['message'],
                'user' => $result['user'] ?? null,
                'token' => $result['token'] ?? null
            ]);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged Out Successfully!'], 200);
    }

    /**
     * Other Authentication Methods
     */
    public function forgetPassword(Request $request) {

    }

    public function resetPassword(Request $request) {

    }

}
