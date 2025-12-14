<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Tampilkan profil (dipanggil dari header dropdown)
    public function index()
    {
        $user = Auth::user();
            $layout = $user->role === 'admin' ? 'layouts.app_admin' : 'layouts.app';

        return view('profile.index', compact('user','layout'));
    }

    // Form edit profil
    public function edit()
    {
        $user = Auth::user();
            $layout = $user->role === 'admin' ? 'layouts.app_admin' : 'layouts.app';

        return view('profile.edit', compact('user','layout'));
    }

    // Simpan perubahan profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'job'=> 'nullable|string|max:100',
            'telepon'  => 'nullable|string|max:20',
            'foto'     => 'nullable|image|max:2048', // jpg/png/webp max 2MB
        ]);

        // Update field dasar
        $user->name      = $validated['name'];
        $user->email     = $validated['email'];
        $user->job = $validated['job'] ?? null;
        $user->telepon   = $validated['telepon'] ?? null;

        // Upload foto (opsional)
        if ($request->hasFile('foto')) {
            // hapus foto lama kalau ada
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $path = $request->file('foto')->store('profile', 'public');
            $user->foto = $path; // pastikan kolom 'foto' ada di tabel users
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    // Opsional: hapus akun (kalau route-nya ada)
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password', // kalau mau validasi password
        ]);

        $user = $request->user();

        // Hapus foto dari storage
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
    
}
