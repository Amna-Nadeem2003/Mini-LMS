<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    // ========================================
    // AUTOMATIC SESSION CREATION ON LOGIN
    // ========================================
    
    $user = Auth::user();
    
    // 1. Login Counter - Increment in DATABASE (persists across sessions)
    $user->increment('login_counter');
    $user->last_login_at = now();
    $user->save();
    
    // Store in session for easy access
    Session::put('login_counter', $user->login_counter);
    
    // 2. Last Login Time
    Session::put('last_login_time', now()->format('Y-m-d H:i:s'));
    
    // 3. Username
    Session::put('username', $user->name);
    
    // 4. Role (default to 'Student' - you can modify based on your system)
    Session::put('role', 'Student');
    
    // 5. Create Associative Array for JSON Storage
    $academicData = [
        'course' => 'Web Engineering',
        'semester' => '7th Semester',
        'year' => '2022-2026',
        'gpa' => '3.4',
        'department' => 'CS'
    ];
    
    // Convert array to JSON and store in session
    $academicDataJson = json_encode($academicData);
    Session::put('academic_data_json', $academicDataJson);
    
    // Also store the original array for easy access
    Session::put('academic_data', $academicData);
    
    // Optional: Store additional user info
    Session::put('user_email', $user->email);
    Session::put('user_id', $user->id);

    return redirect()->intended(route('dashboard', absolute: false));
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}