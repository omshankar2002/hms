<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Popup;

class PopupController extends Controller
{
    public function edit()
    {
        $popup = Popup::first(); // always one record
        if (!$popup) {
            $popup = Popup::create([
                'message' => '',
                'is_active' => false,
            ]);
        }
        return view('admin.popup.edit', compact('popup'));
    }

   public function update(Request $request)
{
    $popup = Popup::first();

    $popup->message = $request->input('message');
    $popup->is_active = (int) $request->input('is_active', 0); // force integer

    $popup->save();

    return redirect()->back()->with('success', 'Popup updated successfully.');
}

}
