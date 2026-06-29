<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;

class SocialLinksController extends Controller
{
    // Display the social links view
    public function view()
    {
        $socialLink = SocialLink::first(); // We assume only one row exists
        return view('admin.social_links.view', compact('socialLink'));
    }

    // Update or create social links
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'nullable|string|max:20',
            'gmail' => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'address_link' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'google' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $socialLink = SocialLink::first();

        if ($socialLink) {
            $socialLink->update($validatedData);
        } else {
            SocialLink::create($validatedData);
        }

        return response()->json([
            'status' => true,
            'message' => 'Social links updated successfully.'
        ]);
    }
}
