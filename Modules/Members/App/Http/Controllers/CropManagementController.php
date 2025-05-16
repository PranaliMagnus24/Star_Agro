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
use App\Models\CropInquiry;
use App\Models\City;
use App\Models\QuantityMass;
use Yajra\DataTables\Facades\DataTables;

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
    if ($request->ajax())
    {
        $datas = CropManagement::withCount('inquiries')
                ->where('farmer_id', $user->id)
                ->orderBy('created_at', 'desc');
            return DataTables::eloquent($datas)
            ->addIndexColumn()
            ->addColumn('crop_name', function ($data)
            {
                return ucfirst($data->crop_name);
            })
            ->addColumn('planating_date', function ($data)
            {
                 return \Carbon\Carbon::parse($data->planating_date)->format('d F Y');
            })
            ->addColumn('harvesting_start_date', function ($data)
            {
                return \Carbon\Carbon::parse($data->harvesting_start_date)->format('d F Y');
            })
            ->addColumn('harvesting_end_date', function ($data)
            {
                 return \Carbon\Carbon::parse($data->harvesting_end_date)->format('d F Y');
            })
            ->addColumn('expected_price', function ($data)
            {
                return $data->expected_price;
            })
            ->addColumn('inquiry_count', function ($data)
            {
                return '<a href="' . route('crop.inquiries', $data->id) . '">' . $data->inquiries_count . '</a>';
            })
            ->addColumn('action', function ($data) {
    $editUrl = route('crop.edit', $data->id);
    $deleteUrl = route('crop.delete', $data->id);

    return '
    <div class="d-flex align-items-center nowrap">
        <a href="'.$editUrl.'" class="btn btn-primary me-1">
            <i class="bi bi-pencil-square"></i>
        </a>
        <form action="'.$deleteUrl.'" method="POST" onsubmit="return confirm(\'Are you sure?\');" style="display:inline;">
            '.csrf_field().'
            '.method_field('DELETE').'
            <button type="submit" class="btn btn-danger me-1 mt-3">
                <i class="bi bi-trash3-fill"></i>
            </button>
        </form>
    </div>';
})
            ->rawColumns(['inquiry_count', 'action'])
            ->make(true);
        }
        return view('members::crop_management.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function createCrop()
    {
        // $categories = Category::all();
       $categories = Category::where('parent_id', 0)
                      ->where('subcategory_id', 0)
                      ->get();
        $datas = QuantityMass::all();
        return view('members::crop_management.create', compact('categories','datas'));
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)

    {
       // dd($request->all());

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:categories,id',
            'crop_id' => 'required|exists:categories,id',
            'planating_date' => 'required|date',
            'harvesting_start_date' => 'required|date',
            'harvesting_end_date' => 'required|date',
            'expected_price' => 'nullable|numeric',
            'min_qty' => 'nullable|numeric',
            'max_qty' => 'nullable|numeric',
            'min_qty_mass' => 'nullable|string',
            'max_qty_mass' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
           'crop_images.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'crop_video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:2048',
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
            'harvesting_start_date' => $request->harvesting_start_date,
            'harvesting_end_date' => $request->harvesting_end_date,
            'expected_price' => $request->expected_price,
            'min_qty' => $request->min_qty,
            'min_qty_mass' => $request->min_qty_mass,
            'max_qty' => $request->max_qty,
            'max_qty_mass' => $request->max_qty_mass,
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

        if ($request->hasFile('crop_video')) {
            $videoFile = $request->file('crop_video');
            if ($videoFile->isValid()) {
                $videoFilename = Str::random(30) . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->move(public_path('upload/crop_images/' . Auth::id()), $videoFilename);

                // Store the video path in the Crop_video table
                CropImages::create([
                    'farmer_id' => Auth::id(),
                    'crop_id' => $cropManagement->id,
                    'crop_video' => 'upload/crop_images/' . Auth::id() . '/' . $videoFilename,
                ]);
            } else {
                \Log::error('Invalid video file: ' . $videoFile->getClientOriginalName());
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
    public function editCrops($id)
    {
        $data = CropManagement::findOrFail($id);
           $categories = Category::where('parent_id', 0)
                      ->where('subcategory_id', 0)
                      ->get();
        return view('members::crop_management.edit', compact('data','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCrops(Request $request, $id): RedirectResponse
    {
        $cropManagement = CropManagement::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:categories,id',
            'crop_id' => 'required|exists:categories,id',
            'planating_date' => 'required|date',
            'harvesting_start_date' => 'required|date',
            'harvesting_end_date' => 'required|date',
            'expected_price' => 'nullable|numeric',
            'min_qty' => 'nullable|numeric',
            'max_qty' => 'nullable|numeric',
            'min_qty_mass' => 'nullable|string',
            'max_qty_mass' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'crop_images.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'crop_video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:2048',
        ]);

        $cropManagement->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'crop_id' => $request->crop_id,
            'planating_date' => $request->planating_date,
            'harvesting_start_date' => $request->harvesting_start_date,
            'harvesting_end_date' => $request->harvesting_end_date,
            'expected_price' => $request->expected_price,
            'min_qty' => $request->min_qty,
            'min_qty_mass' => $request->min_qty_mass,
            'max_qty' => $request->max_qty,
            'max_qty_mass' => $request->max_qty_mass,
            'description' => $request->description,
            'status' => $request->status,
            'type' => $request->crop_type,
            
            
            
        ]);

        // Handle crop images
        if ($request->hasFile('crop_images')) {
            $userFolder = public_path('upload/crop_images/' . Auth::id());
            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0755, true);
            }

            foreach ($request->file('crop_images') as $file) {
                if ($file->isValid()) {
                    $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
                    $file->move($userFolder, $filename);

                    CropImages::create([
                        'farmer_id' => Auth::id(),
                        'crop_id' => $cropManagement->id,
                        'crop_images' => 'upload/crop_images/' . Auth::id() . '/' . $filename,
                    ]);
                } else {
                    \Log::error('Invalid file: ' . $file->getClientOriginalName());
                }
            }
        }

        // Handle crop video
        if ($request->hasFile('crop_video')) {
            $videoFile = $request->file('crop_video');
            if ($videoFile->isValid()) {
                $videoFilename = Str::random(30) . '.' . $videoFile->getClientOriginalExtension();
                $videoFile->move(public_path('upload/crop_images/' . Auth::id()), $videoFilename);
                CropImages::where('crop_id', $cropManagement->id)->update([
                    'crop_video' => 'upload/crop_images/' . Auth::id() . '/' . $videoFilename,
                ]);
            } else {
                \Log::error('Invalid video file: ' . $videoFile->getClientOriginalName());
            }
        }

        return redirect()->route('crop.index')->with('success', 'Crop management data updated successfully!');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroyCrop($id)
    {
        $data = CropManagement::findOrFail($id);
        $data->delete();
        return redirect()->route('crop.index')->with('success', 'Crop management data deleted successfully!');
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



public function showInquiries($cropManagementId)
{
    if (request()->ajax()) {
        $inquiries = CropInquiry::with(['city', 'cropManagement.farmer', 'walletTransactions'])
            ->where('crop_management_id', $cropManagementId);

        return DataTables::of($inquiries)
        ->addColumn('DT_RowIndex', function ($inquiry) {
                // Adding row index
                static $index = 0;
                return ++$index;
            })
            ->addColumn('farmer_name', function ($inquiry) {
                return optional(optional($inquiry->cropManagement)->farmer)->name ?? 'N/A';
            })
            ->addColumn('contact', function ($inquiry) {
                $farmer = optional($inquiry->cropManagement)->farmer;
                return $farmer->phone . ' / ' . $farmer->email;
            })
           ->addColumn('city', function ($inquiry) {
              $farmer = optional($inquiry->cropManagement)->farmer;
              return ($farmer->state ?? '') . ', ' . 
           ($farmer->district ?? 'N/A') . ', ' . 
           ($farmer->town ?? 'N/A');
          })
            ->addColumn('date', function ($inquiry) {
                return $inquiry->created_at->format('d M Y');
            })
            ->rawColumns(['farmer_name', 'contact', 'location', 'date'])
            ->make(true);
    }

    return view('members::crop_management.crop_inquiries', compact('cropManagementId'));
}


}   
