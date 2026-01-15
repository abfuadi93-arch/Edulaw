<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings', [
            'hero' => SiteSetting::getValue('hero_image'),
            'about' => SiteSetting::getValue('about_image'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'about_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
        ]);

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('site', 'public');
            SiteSetting::setValue('hero_image', $path);
        }

        if ($request->hasFile('about_image')) {
            $path = $request->file('about_image')->store('site', 'public');
            SiteSetting::setValue('about_image', $path);
        }

        return back()->with('status', 'Pengaturan tersimpan.');
    }
}
