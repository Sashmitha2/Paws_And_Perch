<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
{
    // Retrieve or generate the API token for admin
    $apiToken = auth()->user()->createToken('admin-token')->plainTextToken;

    // Store in session (or pass directly to view)
    session(['api_token' => $apiToken]);

    // Pass token explicitly to view as a fallback
    return view('admin.dashboard', [
        'apiToken' => $apiToken,
        
    ]);
}

}
