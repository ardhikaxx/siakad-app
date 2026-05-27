<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak terdaftar dalam sistem kami.');
        }

        // Simpan email di session untuk digunakan di halaman reset
        session(['reset_email' => $request->email]);

        return redirect()->route('password.reset');
    }

    public function showResetForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }

        $email = session('reset_email');
        return view('auth.passwords.reset', compact('email'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('password.request')->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus email dari session
        session()->forget('reset_email');

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
    }
}
