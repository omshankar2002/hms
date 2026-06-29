<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10); // ✅ Use paginate instead of get
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'comments' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->comments = $request->comments;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('uploads/testimonials'), $imageName);
    
            $testimonial->image = 'uploads/testimonials/' . $imageName;
        }
    
        $testimonial->status = 1;
        $testimonial->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Testimonial created successfully'
        ]);
    }
    

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
    
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'comments' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Update the testimonial data
        $testimonial->name = $request->name;
        $testimonial->comments = $request->comments;
    
        if ($request->hasFile('image')) {
            // If there's an existing image, delete it from storage
            if ($testimonial->image && file_exists(storage_path('app/public/' . $testimonial->image))) {
                unlink(storage_path('app/public/' . $testimonial->image));
            }
    
            // Store the new image
            $imagePath = $request->file('image')->store('testimonials', 'public');
            $testimonial->image = $imagePath;
        }
    
        $testimonial->save();
    
        // Return JSON response
        return response()->json(['status' => true]);
    }
    
    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();

            return response()->json(['status' => true, 'message' => 'Deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Delete failed', 'error' => $e->getMessage()], 500);
        }
    }
}
