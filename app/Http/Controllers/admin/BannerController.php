<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image; // if needed
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function edit()
    {
        $banner = Banner::first();
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request)
    {
        $banner = Banner::first();

        $request->validate([
            'subtitle' => 'nullable|string|max:255',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url',
            'clients_count' => 'nullable|integer',
            'uptime' => 'nullable|string|max:10',
            'support_hours' => 'nullable|string|max:20',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'hero_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'hero_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if (!$banner) {
            $banner = new Banner();
        }

        $banner->subtitle = $request->subtitle;
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->button_text = $request->button_text;
        $banner->button_url = $request->button_url;
        $banner->clients_count = $request->clients_count;
        $banner->uptime = $request->uptime;
        $banner->support_hours = $request->support_hours;

       if ($request->hasFile('background_image')) {
    $image = $request->file('background_image');
    $imageName = time() . '_bg.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads/banner'), $imageName);
    $banner->background_image = 'uploads/banner/' . $imageName;
}

if ($request->hasFile('hero_image_1')) {
    $image = $request->file('hero_image_1');
    $imageName = time() . '_hero1.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads/banner'), $imageName);
    $banner->hero_image_1 = 'uploads/banner/' . $imageName;
}

if ($request->hasFile('hero_image_2')) {
    $image = $request->file('hero_image_2');
    $imageName = time() . '_hero2.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads/banner'), $imageName);
    $banner->hero_image_2 = 'uploads/banner/' . $imageName;
}
        $banner->save();

        return redirect()->route('admin.banner.edit')->with('success', 'Banner updated successfully!');
    }
}
