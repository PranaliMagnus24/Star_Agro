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
use App\Models\Faq;
use App\Models\FarmerDocument;
use Modules\Category\App\Models\Category;
use Modules\Members\App\Models\CropImages;
use Modules\Members\App\Models\CropManagement;
use Str;
use File;

class HomeController extends Controller
{
    public function mainIndex()
{
    $datas = Faq::take(3)->get(); //limit(3)
    return view('frontend.menus.home', compact('datas'));
}


    // public function liveSearch(Request $request)
    // {
    //     $query = $request->input('query');

    //     // Initialize a collection to hold the results
    //     $results = collect();

    //     if ($query) {
    //         // Search in categories
    //         $categories = Category::search($query)->take(5)->get();
    //         $results = $results->merge($categories->map(function($item) {
    //             return [
    //                 'id' => $item->id,
    //                 'name' => $item->category_name,
    //                 'description' => $item->description,
    //                 'url' => route('crop.management.list', ['categoryId' => $item->id]), // URL for category
    //             ];
    //         }));

    //         // Search in crop management
    //         $crops = CropManagement::search($query)->take(5)->get();
    //         $results = $results->merge($crops->map(function($item) {
    //             return [
    //                 'id' => $item->id,
    //                 'name' => $item->crop_name,
    //                 'planating_date' => $item->planating_date,
    //                 'expected_price' => $item->expected_price,
    //                 'min_qty' => $item->min_qty,
    //                 'max_qty' => $item->max_qty,
    //                 'type' => $item->type,
    //                 'description' => $item->description,
    //                 'harvesting_start_date' => $item->harvesting_start_date,
    //                 'harvesting_end_date' => $item->harvesting_end_date,
    //                 'url' => route('crop.management.list', ['categoryId' => $item->crop_id]), // URL for crop management
    //             ];
    //         }));
    //     }

    //     // Return the results as a JSON response
    //     return response()->json($results);
    // }


    public function mainAbout()
    {
        return view('frontend.menus.about');
    }

    public function mainServices()
    {
        return view('frontend.menus.services');
    }

    public function mainGallery()
    {
        return view('frontend.menus.gallery');
    }

    public function mainBlog()
    {
        return view('frontend.menus.blog');
    }

    public function mainContact()
    {
        return view('frontend.menus.contact');
    }

    public function mainFaq()
{
    $faqs = Faq::all(); 
    return view('frontend.menus.faq', compact('faqs')); 
}



    public function fetchState(Request $request)
    {

        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["name", "id"]);
                                return response()->json($data);
    }


    public function fetchCity(Request $request)
    {

    $data['cities'] = City::where("state_id", $request->state_id)

                                ->get(["name", "id"]);



    return response()->json($data);

    }

}
