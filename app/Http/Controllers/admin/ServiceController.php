<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();
    
        if ($request->has('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }
    
        $services = $query->orderBy('id', 'desc')->paginate(10); // 👈 this is important
    
        return view('admin.services.index', compact('services'));
    }
    

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'status' => $request->status,
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Service added successfully'
        ]);
    }    

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
            'status' => 'nullable|in:0,1'
        ]);
    
        if ($request->ajax()) {
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }
    
            $service->update($request->only(['title', 'description', 'icon', 'status']));
    
            return response()->json([
                'status' => true,
                'message' => 'Service updated successfully'
            ]);
        }
    
        // fallback for non-AJAX
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $service->update($request->only(['title', 'description', 'icon', 'status']));
        return redirect()->route('services.index')->with('success', 'Service updated');
    }
    
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Service deleted successfully'
        ]);
    }
    
}

