<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class FaqCategoryController extends Controller
{
    public function index(Request $request)
    {
       if ($request->ajax()) {
            $categories = FaqCategory::query()->orderBy('created_at', 'desc');
            

            return DataTables::eloquent($categories)
                ->addIndexColumn()
                ->addColumn('name', function ($category) {
                    return ucfirst($category->name);
                })
                ->addColumn('description', function ($category) {
                    return $category->description ?? '-';
                })
                ->addColumn('status', function ($category) {
                    return ucfirst($category->status);
                })
                ->addColumn('action', function ($category) {
                    return '
                     <div class="d-flex align-items-center nowrap">
                       <a href="' . route('admin.faq.faqCategory.edit', $category->id) . '" class="btn btn-success btn-sm me-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="' . route('admin.faq.faqCategory.delete', $category->id) . '" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
                    </div>           
                   ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.faq.faqCategory.index');
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