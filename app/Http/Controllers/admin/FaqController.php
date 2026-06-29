<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::orderBy('created_at', 'desc') 
                   ->when($request->has('keyword'), function($query) use ($request) {
                       $query->where('question', 'like', '%'.$request->keyword.'%');
                   })
                   ->paginate(10); // ◀️ Changed from get() to paginate()
                   
        return view('admin.faqs.index', compact('faqs'));
    }
    public function create(Request $request)
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|boolean'
        ]);

        Faq::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'FAQ successfully created'
        ]);

    } catch (\Exception $e) {
        Log::error('FAQ Create Error: '.$e->getMessage());
        return response()->json([
            'status' => false,
            'errors' => ['Something went wrong. Please try again.']
        ], 500);
    }
}

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
{
    $validated = $request->validate([
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
        'status' => 'required|boolean'
    ]);

    $faq->update($validated);

    return response()->json([
        'status' => true,
        'message' => 'FAQ updated successfully'
    ]);
}
  public function destroy(Faq $faq)
{
    $faq->delete();

    return response()->json(['status' => true, 'message' => 'FAQ deleted successfully']);
}

}