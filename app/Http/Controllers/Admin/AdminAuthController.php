<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {

        $attributes =  $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(!Auth::guard('admin')->attempt($attributes)){
            throw ValidationException::withMessages([
                'password' => 'Credential does not match'
            ]);
        }
        session()->regenerate();
        return redirect()->route('admin.dashboard')->with('success', 'Welcome Sir !');
    }

    public function destroy()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
