<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class HeroController extends Controller
{
    public function edit()
    {
        $heroImage = SiteSetting::getValue('hero_background', asset('images/hero-bg.jpg'));
        return view('admin.hero.edit', compact('heroImage'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_background' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Simpan file ke storage
        $path = $request->file('hero_background')->store('hero', 'public');

        // Simpan path ke database
        SiteSetting::setValue('hero_background', 'storage/' . $path);

        return redirect()->route('admin.hero.edit')->with('success', 'Background hero berhasil diperbarui!');
    }
}
