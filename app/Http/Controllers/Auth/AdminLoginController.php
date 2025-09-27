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

    // public function store(Request $request)
    // {

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

    //     $credentials = $request->validate([
    //     'email' => 'required|email',
    //     'password' => 'required',
    // ]);

    // if (Auth::attempt($credentials)) {
    //     $user = Auth::user();
    // $token = $user->createToken('admin-token')->plainTextToken;

    // session(['api_token' => $token]);
    //     //$request->session()->regenerate();

    //     return redirect()->intended('/admin/dashboard');
    // }

    // return back()->withErrors([
    //     'email' => 'The provided credentials do not match our records.',
    // ]);

    // }

  

// public function store(Request $request)
// {
//     $credentials = $request->validate([ 
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     if (Auth::attempt($credentials)) {
//         $user = Auth::user();
//         $token = $user->createToken('admin-token')->plainTextToken;

//         session(['api_token' => $token]);

//         // ✅ Flash success message to session
//         Session::flash('success', 'Login successful!');

//         return redirect()->intended('/admin/dashboard');
//     }

//     // ❌ Flash error message to session
//     return back()->withErrors([
//         'email' => 'The provided credentials do not match our records.',
//     ])->withInput()->with('error', 'Invalid login credentials.');
// }

// public function store(Request $request)
// {
//     $credentials = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     if (Auth::attempt($credentials)) {
//         $user = Auth::user();

//         // ✅ Check if the user is actually an admin
//         if ($user->role !== 'Admin') {
//             Auth::logout(); // log out the unauthorized user
//             return back()->withErrors([
//                 'email' => 'Unauthorized login attempt.',
//             ])->withInput()->with('error', 'You are not allowed to access the admin panel.');
//         }

//         // ✅ Create Sanctum token (if needed)
//         $token = $user->createToken('admin-token')->plainTextToken;
//         session(['api_token' => $token]);

//         // ✅ Flash success message
//         Session::flash('success', 'Login successful!');

//         //return redirect()->intended('/admin/dashboard');

//         return redirect()->route('admin.dashboard');

//     }

//     // ❌ Invalid credentials
//     return back()->withErrors([
//         'email' => 'The provided credentials do not match our records.',
//     ])->withInput()->with('error', 'Invalid login credentials.');
// }

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




    public function destroy( Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
