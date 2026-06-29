<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::withCount('rooms')->latest()->get();
        return view('admin.room_types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('admin.room_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'base_price'  => 'required|numeric|min:0',
            'max_adults'  => 'required|integer|min:1',
            'max_children'=> 'required|integer|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $data           = $request->except('image');
        $data['slug']   = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/room_types'), $fileName);
            $data['image'] = 'uploads/room_types/' . $fileName;
        }

        RoomType::create($data);

        return redirect()->route('room-types.index')->with('success', 'Room Type created successfully.');
    }

    public function edit(RoomType $roomType)
    {
        return view('admin.room_types.edit', compact('roomType'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'base_price'  => 'required|numeric|min:0',
            'max_adults'  => 'required|integer|min:1',
            'max_children'=> 'required|integer|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $data         = $request->except('image');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($roomType->image && file_exists(public_path($roomType->image))) {
                unlink(public_path($roomType->image));
            }
            $image    = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/room_types'), $fileName);
            $data['image'] = 'uploads/room_types/' . $fileName;
        }

        $roomType->update($data);

        return redirect()->route('room-types.index')->with('success', 'Room Type updated successfully.');
    }

    public function destroy(RoomType $roomType)
    {
        if ($roomType->rooms()->count() > 0) {
            return back()->with('error', 'Cannot delete room type with existing rooms.');
        }
        if ($roomType->image && file_exists(public_path($roomType->image))) {
            unlink(public_path($roomType->image));
        }
        $roomType->delete();
        return redirect()->route('room-types.index')->with('success', 'Room Type deleted successfully.');
    }
}
