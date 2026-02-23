<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminSessionController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin(): View|RedirectResponse
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Attempt admin login.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = AdminUser::where('user', $credentials['user'])->first();

        if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
            return back()
                ->withInput($request->only('user'))
                ->withErrors(['user' => 'Credenciales incorrectas. Intente de nuevo.']);
        }

        $request->session()->regenerate();
        session(['admin_id' => $admin->id, 'admin_user' => $admin->user]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_id', 'admin_user']);

        return redirect()->route('admin.login');
    }
}
