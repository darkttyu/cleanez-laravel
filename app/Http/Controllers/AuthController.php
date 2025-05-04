<?php

namespace App\Http\Controllers;
use App\Mail\VerificationEmail;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * User Authentication Main Methods
     */
    public function signup(SignupRequest $request) {
        $validated = $request->validated();

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'date_of_birth' => $validated['date_of_birth'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'address' => [
                'province' => $validated['address']['province'],
                'municipal' => $validated['address']['municipal'],
                'barangay' => $validated['address']['barangay'],
                'block' => $validated['address']['block'],
            ]
        ]);

        $token = $user->createToken('email-verification')->plainTextToken;

        $verificationURL = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
                'token' => $token
            ]
        );

            Mail::to($user->email)->send(new VerificationEmail($user->first_name, $verificationURL, $token));

            return response()->json([
                'message' => 'User Created Successfully!',
                'user' => $user->makehidden(['password', 'remember_token']),
                'redirect' => 'email/verify'
            ], 200);
    }

    public function verify(Request $request) {
        $user = User::findOrFail($request->id);

        if (!$request->hasValidSignature()) {
            abort(403, 'Invalid or expired verification link.');
        }

        $tokenParts = explode('|', $request->token);
        if (count($tokenParts) !== 2) {
            abort(403, 'Invalid token format.');
        }

        $tokenRecord = PersonalAccessToken::find($tokenParts[0]);

        if (!$tokenRecord || ! hash_equals($tokenRecord->token, hash('sha256', $tokenParts[1]))) {
            abort(403, 'Invalid or expired token.');
        }

        if (!Auth::check()) {
            Auth::login($user);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            $user->is_verified = true;
            $user->save();

            $tokenRecord->delete();
        }

        return redirect()->route('email-verified')->with('message', 'Email Verified Successfully!');
    }

    public function login(LoginRequest $request) {

        $validated = $request->validated();

        // Fetches User from DB
        $user = User::where('email', $validated['email'])->first();

            // Checks if user exists and if password is correct
            if(!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            }

            // Deletes previous tokens.
            $user->tokens()->delete();

            $token = $user->createToken('auth_token', ['*'], now()->addMinutes(60))->plainTextToken;
            $user->last_login_at = now();

            $user->save();

            return response()->json([
                'message' => 'Login Successful!',
                'access_token' => $token,
                'token_type' => 'Bearer'], 200);
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
