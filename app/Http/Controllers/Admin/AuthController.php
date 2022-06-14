<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Admin Login System
    public function login_Admin(Request $request) {
        if(!Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))) {
            throw ValidationException::withMessages([
                'email' => "Credentials didn't match.",
            ]);
        }

        return redirect()->intended(route('admin.dashboard'));
    }


    // Admin Restration System
    public function admin_registration(Request $request) {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    // Logout Admin
    public function logout() {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
