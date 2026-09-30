<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $credential = $request->validated();
        $user = \App\Models\User::withTrashed()->where('email', $credential['email'])->first();
        // Check if the user soft deleted
        if (!$user) {
            return back()->withErrors(['email' => 'These credentials do not match our records.']);
        }
        
        if ($user && $user->trashed()) {
            return redirect()->route('archive.show', ['user' => $user->id]);
        }

        if ($user->status == 'deactivated') {
            return redirect()->route('archive.show', ['user' => $user->id]);
        }


        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('UserDashboard', absolute: false));

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
