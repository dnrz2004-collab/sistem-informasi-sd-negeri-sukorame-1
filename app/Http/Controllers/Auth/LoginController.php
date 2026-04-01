<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    private function redirectByRole()
    {
        return match(auth()->user()->role) {
            'admin'      => redirect()->route('admin.dashboard'),
            'guru'       => redirect()->route('guru.dashboard'),
            'wali_murid' => redirect()->route('wali.dashboard'),
            'siswa'      => redirect()->route('siswa.dashboard'),
            default      => redirect('/'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}