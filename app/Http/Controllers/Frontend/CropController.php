<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\User;
use App\Models\FarmerDocument;
use Modules\Category\App\Models\Category;
use Modules\Members\App\Models\CropImages;
use Modules\Members\App\Models\CropManagement;
use Str;
use File;

class CropController extends Controller
{
    public function mainCrops(Request $request)
    {
        $subcategoryId = $request->query('subcategory_id');
        $search = $request->query('search');

        $query = Category::query();

        if ($subcategoryId) {
            $query->where('subcategory_id', $subcategoryId);
        } else {
            $query->where('parent_id', '>', 0)->where('subcategory_id', '>', 0);
        }

        if ($search) {
            $query->where('category_name', 'like', '%' . $search . '%');
        }

        $categories = $query->withCount('cropManagements')->paginate(12);

        return view('frontend.crops.crops', compact('categories'));
    }


    public function showCropManagementList($categoryId)
{
    $cropManagements = CropManagement::where('crop_id', $categoryId)->get();


    return view('frontend.crops.crops_list', compact('cropManagements'));
}



}
