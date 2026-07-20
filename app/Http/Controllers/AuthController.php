<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Legacy / general login form redirect to user login
    public function showLoginForm()
    {
        return redirect()->route('login.user');
    }

    // Process legacy login
    public function login(Request $request)
    {
        return $this->userLogin($request);
    }

    // Tampilkan Halaman Login User (Member)
    public function showUserLogin()
    {
        return view('auth.login-user');
    }

    // Proses Login User (Member)
    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->isMember()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun ini bukan user/member. Silakan gunakan Login Admin.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect()->route('member.adopsi.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Tampilkan Halaman Login Admin
    public function showAdminLogin()
    {
        return view('auth.login-admin');
    }

    // Proses Login Admin
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->isAdmin()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun ini bukan admin. Silakan gunakan Login User.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect('/')->with('success', 'Selamat datang Admin!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Tampilkan halaman register admin
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi admin dengan verifikasi kode keamanan
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'kode_keamanan' => ['required', function ($attribute, $value, $fail) {
                if ($value !== env('ADMIN_REGISTRATION_CODE')) {
                    $fail('Kode keamanan pendaftaran tidak valid.');
                }
            }],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect('/')->with('success', 'Registrasi admin berhasil!');
    }

    // Tampilkan halaman register member (publik)
    public function showMemberRegister()
    {
        return view('auth.member-register');
    }

    // Proses registrasi member (tanpa kode rahasia)
    public function memberRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('member.adopsi.dashboard')->with('success', 'Selamat datang! Akun member My Cemara Anda berhasil dibuat.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.user');
    }
}
