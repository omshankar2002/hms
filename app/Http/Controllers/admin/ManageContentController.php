<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManageContent;

class ManageContentController extends Controller
{
    public function index()
    {
        // Fetch all manage content entries from the database
        $manageContents = ManageContent::all();

        // Pass the data to the view
        return view('admin.manage_content.index', compact('manageContents'));
    }

    public function create()
    {
        return view('admin.manage_content.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'description');

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/contents'), $filename);
            $data['image'] = $filename;
        }

        // Create the new content
        ManageContent::create($data);

        // Flash success message to session and redirect
        session()->flash('success', 'Content created successfully.');

        // For AJAX: Send JSON response with status
        return response()->json([
            'status' => true,
        ]);
    }

    public function destroy($id)
    {
        $content = ManageContent::findOrFail($id);
    
        if ($content->image && file_exists(public_path('uploads/manage_content/' . $content->image))) {
            unlink(public_path('uploads/manage_content/' . $content->image));
        }
    
        $content->delete();
        
        // Flash success message to session and redirect
        session()->flash('success', 'Content deleted successfully.');
    
        return response()->json([
            'status' => true,
        ]);
    }
    
}
