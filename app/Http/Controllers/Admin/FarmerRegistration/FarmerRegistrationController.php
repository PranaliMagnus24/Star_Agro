<?php

namespace App\Http\Controllers\Admin\FarmerRegistration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\App\Models\Category;

class FarmerRegistrationController extends Controller
{
    public function farmerIndex(Request $request)
    {
        return view('admin.farmer_registration.farmer_index');
    }

    public function farmerCreate()
    {
        $categories = Category::all();
        return view('admin.farmer_registration.farmer_create', compact('categories'));
    }


}
