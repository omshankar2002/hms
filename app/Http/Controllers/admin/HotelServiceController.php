<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HotelService;
use Illuminate\Http\Request;

class HotelServiceController extends Controller
{
    public function index()
    {
        $services = HotelService::latest()->paginate(20);
        return view('admin.hotel_services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.hotel_services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'price'       => 'required|numeric|min:0',
            'unit'        => 'required|string',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        HotelService::create($request->all());

        return redirect()->route('hotel-services.index')->with('success', 'Hotel Service created.');
    }

    public function edit(HotelService $hotelService)
    {
        return view('admin.hotel_services.edit', compact('hotelService'));
    }

    public function update(Request $request, HotelService $hotelService)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string',
            'price'       => 'required|numeric|min:0',
            'unit'        => 'required|string',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $hotelService->update($request->all());

        return redirect()->route('hotel-services.index')->with('success', 'Hotel Service updated.');
    }

    public function destroy(HotelService $hotelService)
    {
        $hotelService->delete();
        return redirect()->route('hotel-services.index')->with('success', 'Hotel Service deleted.');
    }
}
