<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt login
    if (!Auth::guard('customer')->attempt($credentials)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid login credentials');
    }

    $user = Auth::guard('customer')->user();

    if ($user->role !== 'Customer') {
        Auth::guard('customer')->logout();

        return redirect()->back()
            ->withInput()
            ->with('error', 'Access denied: Only customers can log in here.');
    }

    $request->session()->regenerate();

    return redirect()->intended('/home');
}


//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',

//         ]);

//         //if (!Auth::attempt($request->only('email', 'password'))) {
//           //  return response()->json(['message'=>'Invalid login credentials'], 401);

//         if (!Auth::attempt($request->only('email', 'password'))) {
//     return redirect()->back()
//         ->withInput()
//         ->with('error', 'Invalid login credentials');
// }

            
        

//         /** @var \App\Models\User $user **/
//         $user = Auth::user();
//         $token = $user->createToken('api_token')->plainTextToken;

//         return response()->json([
//             'message'=>'Login successful',
//             'token'=> $token,
//             'user'=> $user,
//         ]);

//     }

    // public function logout(Request $request)
    // {
    //     $request->user()->currentAccessToken()->delete();
        
    //     return response()->json(['message' => 'Logged out successfully']);
    // }

    public function logout(Request $request)
    {
        auth()->logout();  // Log the user out of the session

        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate CSRF token

        return redirect()->route('login');  // Redirect to customer login page
    }

}
