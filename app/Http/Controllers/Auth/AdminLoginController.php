<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
class AdminLoginController extends Controller
{
    public function create()
    {
        return view('auth.admin-login'); // blade view for admin

    }

    public function store(Request $request)
    {

        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required|string',
        // ]);

        // if(Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))){
        //     /** @var \App\Models\User $user  **/
        //     $user = Auth::user();
        //     if($user->role === 'Admin'){


        //         //creating api token and storing in session
        //         $token = $user->createToken('admin-panel')->plainTextToken;
        //         session(['api_token' => $token]);


        //         return redirect()->route('admin.dashboard');

        //     }
        //     Auth::logout();
        //     return back()->withErrors(['email' => 'Unauthorized login attempt']);

        // }
        // return back()->withErrors(['email' => 'Invalid credentials']);


        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();

        //     // Generate Sanctum token for admin
        //     $token = $user->createToken('admin-token')->plainTextToken;

        //     // Return token in JSON response (or send to frontend)
        //     return response()->json([
        //         'message' => 'Login successful',
        //         'token' => $token,
        //         'user' => $user,
        //     ]);
        // }

        // return response()->json(['message' => 'Invalid credentials'], 401);

        $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
    $token = $user->createToken('admin-token')->plainTextToken;

    session(['api_token' => $token]);
        //$request->session()->regenerate();

        return redirect()->intended('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);

    }

    public function destroy( Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
