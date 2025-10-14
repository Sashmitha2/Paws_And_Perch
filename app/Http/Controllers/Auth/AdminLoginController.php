<?php

namespace App\Http\Controllers\Auth;

  use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
class AdminLoginController extends Controller
{
    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'Customer') {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
        return view('auth.admin-login'); // blade view for admin

    }

   

    //Store a newly created resource in storage
public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('admin')->attempt($credentials)) {
        $user = Auth::guard('admin')->user();

        if ($user->role !== 'Admin') {
            Auth::guard('admin')->logout();

            return back()->withErrors([
                'email' => 'Unauthorized login attempt.',
            ])->withInput()->with('error', 'You are not allowed to access the admin panel.');
        }

        $token = $user->createToken('admin-token')->plainTextToken;
        session(['api_token' => $token]);

        Session::flash('success', 'Login successful!');

        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput()->with('error', 'Invalid login credentials.');
}

/**
     * Handle API login (Postman / mobile apps) and return Sanctum token
     */
    public function apiLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::guard('admin')->user();

        if ($user->role !== 'Admin') {
            Auth::guard('admin')->logout();
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Generate Sanctum token
        $token = $user->createToken('admin-api-token')->plainTextToken;

        return response()->json([
            'message' => 'Admin login successful',
            'token' => $token,
            'user' => $user
        ]);
    }




// remove the specified resource from the storage
    public function destroy( Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
