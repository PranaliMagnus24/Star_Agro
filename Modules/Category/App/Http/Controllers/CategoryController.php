<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::when($search, function ($query) use ($search) {
            return $query->where('category_name', 'like', "%{$search}%");
        })->paginate(20);

        return view('category::index', compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('category::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'category_name' => 'required|string',
        'description' => 'nullable|string',
        'status' => 'required',
        'category_id' => 'nullable|exists:categories,id',
        'subcategory_id' => 'nullable|exists:categories,id',
        'category_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
    ]);

    $category = new Category();
    $category->category_name = $request->category_name;
    $category->description = $request->description;
    $category->status = $request->status;

    if ($request->subcategory_id) {
        $category->parent_id = $request->category_id;
        $category->subcategory_id = $request->subcategory_id;
    } elseif ($request->category_id) {
        $category->parent_id = $request->category_id;
        $category->subcategory_id = 0;
    } else {
        $category->parent_id = 0;
        $category->subcategory_id = 0;
    }

    // ✅ Store Category Image if uploaded
    if ($request->hasFile('category_image')) {
        $image = $request->file('category_image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Unique name
        $imagePath = 'upload/category_img/';

        // Move image to the folder
        $image->move(public_path($imagePath), $imageName);

        // Save image path in the database
        $category->category_image = $imagePath . $imageName;
    }

    $category->save();

    return redirect()->route('category.index')->with('success', 'Category created successfully!');
}




    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all(); // Fetch all categories to populate dropdowns
        return view('category::create', compact('category', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_name' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'category_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->description = $request->description;
        $category->status = $request->status;

        if ($request->subcategory_id) {
            $category->parent_id = $request->category_id;
            $category->subcategory_id = $request->subcategory_id;
        } elseif ($request->category_id) {
            $category->parent_id = $request->category_id;
            $category->subcategory_id = 0;
        } else {
            $category->parent_id = 0;
            $category->subcategory_id = 0;
        }

        if ($request->hasFile('category_image')) {
            if ($category->category_image && file_exists(public_path($category->category_image))) {
                unlink(public_path($category->category_image));
            }

            $image = $request->file('category_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'upload/category_img/';
            $image->move(public_path($imagePath), $imageName);

            $category->category_image = $imagePath . $imageName;
        }

        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }

    public function getSubcategories($id)
    {
        $subcategories = Category::where('parent_id', $id)->get();
        return response()->json($subcategories);
    }

    public function getSubSubcategories($id)
    {
        $subsubcategories = Category::where('subcategory_id', $id)->get();
        return response()->json($subsubcategories);
    }

}
