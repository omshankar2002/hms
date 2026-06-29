<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
public function index()
{
    $blogs = Blog::with('category')->latest()->paginate(10);
    return view('admin.blogs.index', compact('blogs'));
}

    // Show the form for creating a new resource

public function create()
{
  $categories = BlogCategory::all();
    return view('admin.blogs.create', compact('categories'));
}


    // Store a newly created resource in storage

public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:blog_categories,id',
        'title' => 'required|string|max:255',
        'description' => 'required',
        'tags' => 'nullable|string',
        'seo_title' => 'nullable|string|max:255',
        'seo_description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|boolean'
    ]);

    $slug = $request->slug ?? Str::slug($request->title);

    $blog = new Blog();
    $blog->category_id = $request->category_id;
    $blog->title = $request->title;
    $blog->slug = $slug;
    $blog->description = $request->description;
    $blog->tags = $request->tags;
    $blog->seo_title = $request->seo_title;
    $blog->seo_description = $request->seo_description;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Save original
        $image->move(public_path('uploads/blogs/original'), $imageName);

        // Create thumbnail 462x308
        $thumbPath = public_path('uploads/blogs/thumbnail/' . $imageName);
        Image::make(public_path('uploads/blogs/original/' . $imageName))
            ->fit(462, 308)
            ->save($thumbPath);

        $blog->image = $imageName;
    }

    $blog->status = $request->status;
    $blog->save();

    return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
}



    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }
    
public function update(Request $request, Blog $blog)
{
    $slug = $request->slug ?: Str::slug($request->title);

    $validated = $request->validate([
        'category_id' => 'required|exists:blog_categories,id',
        'title' => 'required|max:255',
        'slug' => 'required|unique:blogs,slug,' . $blog->id,
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tags' => 'nullable|string',
        'seo_title' => 'nullable|string|max:255',
        'seo_description' => 'nullable|string',
        'status' => 'required|boolean',
    ]);

    $validated['slug'] = $slug;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Delete old original & thumbnail if exist
        if ($blog->image) {
            $oldOriginal = public_path('uploads/blogs/original/' . $blog->image);
            $oldThumb = public_path('uploads/blogs/thumbnail/' . $blog->image);
            if (file_exists($oldOriginal)) unlink($oldOriginal);
            if (file_exists($oldThumb)) unlink($oldThumb);
        }

        // Save new original
        $image->move(public_path('uploads/blogs/original'), $imageName);

        // Save new thumbnail
        $thumbPath = public_path('uploads/blogs/thumbnail/' . $imageName);
       Image::make(public_path('uploads/blogs/original/' . $imageName))
    ->resize(462, 308, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    })
    ->resizeCanvas(462, 308, 'center', false, '#ffffff')
    ->save($thumbPath);


        $validated['image'] = $imageName;
    }

    $blog->update($validated);

    return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
}


    

private function makeUniqueSlug($slug, $currentBlogId = null)
{
    $originalSlug = $slug;
    $count = 1;

    while (Blog::where('slug', $slug)
                ->where('id', '!=', $currentBlogId)
                ->exists()) {
        $slug = $originalSlug . '-' . $count;
        $count++;
    }

    return $slug;
}

    

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
