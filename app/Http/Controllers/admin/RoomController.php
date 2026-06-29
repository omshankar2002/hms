<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with('roomType');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('room_type_id')) {
            $query->where('room_type_id', $request->room_type_id);
        }

        $rooms     = $query->orderBy('room_number')->paginate(20);
        $roomTypes = RoomType::where('status', 'active')->get();

        return view('admin.rooms.index', compact('rooms', 'roomTypes'));
    }

    public function create()
    {
        $roomTypes = RoomType::where('status', 'active')->get();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number'  => 'required|string|unique:rooms,room_number',
            'floor'        => 'nullable|string',
            'status'       => 'required|in:available,booked,maintenance,cleaning',
            'notes'        => 'nullable|string',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::where('status', 'active')->get();
        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number'  => 'required|string|unique:rooms,room_number,' . $room->id,
            'floor'        => 'nullable|string',
            'status'       => 'required|in:available,booked,maintenance,cleaning',
            'notes'        => 'nullable|string',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        if ($room->bookings()->whereIn('status', ['confirmed', 'checked_in'])->count() > 0) {
            return back()->with('error', 'Cannot delete room with active bookings.');
        }
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
