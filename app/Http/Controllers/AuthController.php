<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public function index() {

    // }

    public function showSignUpForm() {
        return view("auth.signup");
    }

    public function showLoginForm() {
        return view("auth.login");
    }

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

        $user->sendEmailVerificationNotification();
        
        return response()->json([
            'message' => 'User Created Successfully!',
            'user' => $user->makehidden(['password', 'remember_token']),
        ], 200);
    }

    public function verifyEmail(Request $request) {

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
        $request->user()->currentAccessToken()->delete();

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
