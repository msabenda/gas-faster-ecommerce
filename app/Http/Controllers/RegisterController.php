<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'mobile_phone' => ['required', 'string', 'regex:/^\+?[0-9]{10,12}$/', 'unique:users,mobile_phone'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'mobile_phone' => $request->mobile_phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if (!$user) {
                Log::error('Failed to create user', $request->all());
                return redirect()->back()->withErrors(['error' => 'Failed to register. Please try again.'])->withInput();
            }

            return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage(), $request->all());
            return redirect()->back()->withErrors(['error' => 'An error occurred during registration. Please try again.'])->withInput();
        }
    }
}