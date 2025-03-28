<?php

namespace Modules\Members\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\App\Models\Category;
use Modules\Members\App\Models\CropImages;
use Modules\Members\App\Models\CropManagement;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Str;
use File;



class CropManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexCrop(Request $request)
{
    $user = auth()->user();
    $datas = CropManagement::with('user')
                ->where('farmer_id', $user->id);

    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $datas->where(function($query) use ($searchTerm) {
            $query->where('crop_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('planating_date', 'like', '%' . $searchTerm . '%')
                  ->orWhere('harvesting_date', 'like', '%' . $searchTerm . '%');
        });
    }
    $datas = $datas->orderBy('created_at', 'desc')->paginate(10);

    return view('members::crop_management.index', compact('datas', 'user'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function createCrop()
    {
        $categories = Category::all();
        return view('members::crop_management.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:categories,id',
            'crop_id' => 'required|exists:categories,id',
            'planating_date' => 'required|date',
            'harvesting_date' => 'required|date',
            'expected_price' => 'nullable|numeric',
            'min_qty' => 'nullable|numeric',
            'max_qty' => 'nullable|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
           'crop_images.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $category = Category::find($request->crop_id);
        $cropName = $category->category_name;


        $type = [];
    if ($request->has('is_organic')) {
        $type[] = 'organic';
    }
    if ($request->has('is_inorganic')) {
        $type[] = 'inorganic';
    }
    $typeString = implode(',', $type);

        $cropManagement = CropManagement::create([
            'farmer_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'crop_id' => $request->crop_id,
            'crop_name' => $cropName,
            'planating_date' => $request->planating_date,
            'harvesting_date' => $request->harvesting_date,
            'expected_price' => $request->expected_price,
            'min_qty' => $request->min_qty,
            'max_qty' => $request->max_qty,
            'description' => $request->description,
            'status' => $request->status,
            'type' => $typeString,
        ]);

        if ($request->hasFile('crop_images')) {
            $userFolder = public_path('upload/crop_images/' . Auth::id());
            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0755, true);
            }

            foreach ($request->file('crop_images') as $file) {
                // Check if the file is valid
                if ($file->isValid()) {
                    $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
                    $file->move($userFolder, $filename);

                    // Debugging: Check if the file is moved successfully
                    if (file_exists($userFolder . '/' . $filename)) {
                        CropImages::create([
                            'farmer_id' => Auth::id(),
                            'crop_id' => $cropManagement->id,
                            'crop_images' => 'upload/crop_images/' . Auth::id() . '/' . $filename,
                        ]);
                    } else {
                        // Log an error if the file was not moved
                        \Log::error('File not moved: ' . $filename);
                    }
                } else {
                    // Log an error if the file is not valid
                    \Log::error('Invalid file: ' . $file->getClientOriginalName());
                }
            }
        }

        return redirect()->route('crop.index')->with('success', 'Crop management data saved successfully!');
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('members::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('members::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }




public function getSubcategories($categoryId)
{
    $subcategories = Category::where('parent_id', $categoryId)->get();
    return response()->json($subcategories);
}

public function getCrops($subcategoryId)
{
    $crops = Category::where('subcategory_id', $subcategoryId)->get();
    return response()->json($crops);
}

}
