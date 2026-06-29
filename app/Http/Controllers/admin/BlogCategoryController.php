<?php


namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::paginate(10);
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:1,0'
        ]);

        BlogCategory::create($request->all());

        return redirect()->route('blog-categories.index')->with('success', 'Blog category created successfully.');
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog-categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:1,0'
        ]);

        $category = BlogCategory::findOrFail($id);
        $category->update($request->only(['name', 'status']));

        return redirect()->route('blog-categories.index')->with('success', 'Blog category updated successfully.');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('blog-categories.index')->with('success', 'Blog category deleted successfully.');
    }
}
