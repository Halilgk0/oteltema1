<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Lock out an email+IP pair after 5 failed attempts to slow down password guessing
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->withInput($request->only('email'))->withErrors([
                'email' => "Çok fazla hatalı deneme yaptınız. {$seconds} saniye sonra tekrar deneyin.",
            ]);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            $this->storePasswordHash($request);

            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/')->with('success', 'Başarıyla giriş yaptınız.');
        }

        RateLimiter::hit($throttleKey, 60);

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Girdiğiniz bilgiler hatalı.',
        ]);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'country_code' => 'required|string|max:5',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->country_code . $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $this->storePasswordHash($request);

        return redirect()->route('home')->with('success', 'Hesabınız başarıyla oluşturuldu!');
    }

    /**
     * Record the password hash in the session right at sign-in, so the
     * AuthenticateSession middleware can end this session if the password
     * is changed from another device (it otherwise only records it on the
     * session's second request).
     */
    private function storePasswordHash(Request $request): void
    {
        $request->session()->put('password_hash_' . Auth::getDefaultDriver(), Auth::user()->getAuthPassword());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Başarıyla çıkış yaptınız.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validateWithBag('password', [
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed|different:current_password',
        ], [
            'current_password.current_password' => 'Mevcut şifreniz hatalı.',
            'password.different' => 'Yeni şifre mevcut şifreden farklı olmalı.',
            'password.confirmed' => 'Yeni şifreler birbiriyle eşleşmiyor.',
            'password.min' => 'Yeni şifre en az 8 karakter olmalı.',
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Sign out every other device that still has the old password's session
        Auth::logoutOtherDevices($request->password);
        $request->session()->regenerate();

        return redirect()->route('profile')->with('success', 'Şifreniz güncellendi.');
    }

    public function myBookings()
    {
        $bookings = Auth::user()->bookings()->with(['room.roomType'])->orderBy('created_at', 'desc')->get();
        return view('auth.bookings', compact('bookings'));
    }
} 