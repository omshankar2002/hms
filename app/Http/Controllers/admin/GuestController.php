<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::withCount('bookings');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%");
            });
        }

        $guests = $query->latest()->paginate(20);
        return view('admin.guests.index', compact('guests'));
    }

    public function create()
    {
        return view('admin.guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'email'       => 'nullable|email|max:255',
            'id_type'     => 'nullable|string',
            'id_number'   => 'nullable|string',
            'nationality' => 'nullable|string',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string',
            'country'     => 'nullable|string',
            'dob'         => 'nullable|date',
            'gender'      => 'nullable|in:male,female,other',
        ]);

        $guest = Guest::create($request->all());

        if ($request->ajax()) {
            return response()->json(['status' => true, 'guest' => $guest]);
        }

        return redirect()->route('guests.index')->with('success', 'Guest created successfully.');
    }

    public function show(Guest $guest)
    {
        $guest->load('bookings.room.roomType', 'bookings.payments');
        return view('admin.guests.show', compact('guest'));
    }

    public function edit(Guest $guest)
    {
        return view('admin.guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'email'       => 'nullable|email|max:255',
            'id_type'     => 'nullable|string',
            'id_number'   => 'nullable|string',
            'nationality' => 'nullable|string',
            'address'     => 'nullable|string',
            'city'        => 'nullable|string',
            'country'     => 'nullable|string',
            'dob'         => 'nullable|date',
            'gender'      => 'nullable|in:male,female,other',
        ]);

        $guest->update($request->all());

        return redirect()->route('guests.index')->with('success', 'Guest updated successfully.');
    }

    public function destroy(Guest $guest)
    {
        if ($guest->bookings()->count() > 0) {
            return back()->with('error', 'Cannot delete guest with booking history.');
        }
        $guest->delete();
        return redirect()->route('guests.index')->with('success', 'Guest deleted successfully.');
    }

    public function search(Request $request)
    {
        $guests = Guest::where('name', 'like', '%' . $request->q . '%')
                       ->orWhere('phone', 'like', '%' . $request->q . '%')
                       ->orWhere('email', 'like', '%' . $request->q . '%')
                       ->limit(10)->get(['id', 'name', 'phone', 'email']);
        return response()->json($guests);
    }
}
