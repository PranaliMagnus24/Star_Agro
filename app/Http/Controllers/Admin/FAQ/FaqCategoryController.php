<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = FaqCategory::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.faq.faqCategory.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.faq.faqCategory.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        FaqCategory::create($request->all());

        return redirect()->route('admin.faqCategory')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = FaqCategory::findOrFail($id);
        return view('admin.faq.faqCategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = FaqCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.faqCategory')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = FaqCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.faqCategory')->with('success', 'Category deleted successfully.');
    }
}