<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;



class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = FAQ::with('faqcategory')->select('faqs1.*');

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->editColumn('faqcategory.name', function ($faq) {
                    return $faq->faqcategory ? ucfirst($faq->faqcategory->name) : '';
                })
                ->editColumn('status', function ($faq) {
                    return ucfirst($faq->status);
                })
                ->addColumn('action', function ($faq) {
                    return '
                        <div class="d-flex align-items-center nowrap">
                            <a href="' . route('admin.faq.edit', $faq->id) . '" class="btn btn-success btn-sm me-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="' . route('admin.faq.delete', $faq->id) . '" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = FaqCategory::all(); // Fetch all FAQ categories
        return view('admin.faq.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new FAQ entry
        FAQ::create($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'FAQ created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        $categories = FaqCategory::all(); // Fetch all FAQ categories
        return view('admin.faq.edit', compact('faq','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the FAQ entry and update it
        $faq = FAQ::findOrFail($id);
        $faq->update($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ deleted successfully!');
    }

}
