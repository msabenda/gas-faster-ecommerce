<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the home page with user profile and products.
     */
    public function index()
    {
        $user = Auth::user();

        // Redirect admins to Filament dashboard
        if ($user->is_admin) {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        $products = Product::all();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        return view('home', compact('user', 'products', 'cartItems'));
    }

    /**
     * Update the user's profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Prevent admins from updating profile via /home
        if ($user->is_admin) {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'mobile_phone' => ['required', 'string', 'regex:/^\+?[0-9]{10,12}$/', 'unique:users,mobile_phone,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        }

        try {
            $user->update([
                'name' => $request->name,
                'mobile_phone' => $request->mobile_phone,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            return redirect()->route('home')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage(), $request->all());
            return redirect()->route('home')->withErrors(['error' => 'Failed to update profile. Please try again.'])->withInput();
        }
    }
}