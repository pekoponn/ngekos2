<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'phone', 'address', 'bio']));

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        
        // Hapus avatar lama jika ada
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        // Simpan avatar baru
        $path = $request->file('avatar')->store('avatars');
        $user->avatar = $path;
        $user->save();

        return redirect()->route('profile')->with('success', 'Foto profil berhasil diperbarui!');
    }
}