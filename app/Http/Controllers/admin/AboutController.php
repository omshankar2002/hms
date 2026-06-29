<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutSection;

class AboutController extends Controller
{
    /**
     * Show the edit form
     */
    public function edit()
    {
        $about = AboutSection::first();
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update or create the About Section
     */
    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'nullable|string|max:255',
            'sub_heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ]);

        $about = AboutSection::first() ?? new AboutSection();

        $about->heading = $request->heading;
        $about->sub_heading = $request->sub_heading;
        $about->description = $request->description;
        $about->features = $request->features;

        // ✅ Same image handling logic as BannerController
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_about.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $imageName);
            $about->image = 'uploads/about/' . $imageName;
        }

        $about->save();

        return redirect()->route('about.edit')->with('success', 'About section updated successfully!');
    }
}
