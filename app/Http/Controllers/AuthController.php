<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Client;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed!');
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // checkbox

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('dashboard')
                ->with('success', 'Login successful! Welcome back.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid email or password.');
    }



    public function logout()
    {
        Auth::logout(); // logout user
        session()->invalidate(); // invalidate session
        session()->regenerateToken(); // regenerate CSRF token
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }



    public function UpdatePassword(Request $request)
    {

        $client = Auth::user();
        //return $client;
        if (!$client) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 401);
        }

        // Validation rules
        $rules = [
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:8|confirmed',
        ];

        $customMessages = [
            'current_password.required' => 'Current password is required.',
            'new_password.required'     => 'New password is required.',
            'new_password.min'          => 'New password must be at least 8 characters long.',
            'new_password.confirmed'    => 'Password confirmation does not match.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if the current password matches
        if (!Hash::check($request->current_password, $client->password)) {
            return response()->json([
                'message' => 'Current password is incorrect.'
            ], 403);
        }
        // Update the password
        $client->password = Hash::make($request->new_password);
        $client->save();

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully!',
        ], 200);
    }





}
