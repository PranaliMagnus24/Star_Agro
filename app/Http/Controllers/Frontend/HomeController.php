<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\User;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Pages;
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
                    //   original
//     public function liveSearch(Request $request)
// {
//     $query = $request->input('query');

//     $results = collect();

//     if ($query) {
//         $crops = CropManagement::where('crop_name', 'like', "%{$query}%")
//                                 ->orWhere('type', 'like', "%{$query}%")
//                                 ->take(5)
//                                 ->get();

//         $results = $crops->map(function ($item) {
//             return [
//                 'id' => $item->id,
//                 'name' => $item->crop_name,
//                 'url' => route('crop.management.list', ['search' => $item->crop_name])
//             ];
//         });
//     }

//     return response()->json($results);
// }
// public function liveSearch(Request $request)
// {
//     $query = $request->input('search');
//     $results = collect();

//     if ($query) {
//         $crops = CropManagement::where('crop_name', 'like', "%{$query}%")
//                                 ->orWhere('type', 'like', "%{$query}%")
//                                 ->take(5)
//                                 ->get();

//         $results = $crops->map(function ($item) {
//             return [
//                 'id' => $item->id,
//                 'name' => $item->crop_name,
//                 'url' => route('crop.management.list', ['search' => $item->crop_name])
//             ];
//         });
//     }

//     return response()->json($results);
// }


public function liveSearch(Request $request)
{
    $query = $request->input('search');
    $results = collect();

    if ($query) {
        $crops = CropManagement::where('crop_name', 'like', "%{$query}%")
                               ->orWhere('type', 'like', "%{$query}%")
                               ->take(5)
                               ->get();

        $results = $crops->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->crop_name,
                'url' => route('crop.management.list', ['search' => $item->crop_name])
            ];
        });
    }

    return response()->json($results);
}



    public function mainAbout()
    {
        $datas = Faq::take(3)->get(); 
        return view('frontend.menus.about',compact('datas'));
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

    // public function mainTerms(){
    //     return view('frontend.menus.terms');
    // }
//     public function mainTerms()
// {
//     $page = Pages::where('slug', 'terms')->where('status', 'active')->firstOrFail();
//     return view('frontend.menus.terms', compact('page'));
// }

public function mainTerms($slug)
{  $pages=Pages::all();
    $page = Pages::where('slug', $slug)->firstOrFail(); 
    //$page = Page::whereSlug($slug)->first();
    return view('frontend.menus.terms', compact('pages','page'));
    
}



//     public function mainFaq()
// {
//     $faqs = Faq::all(); 
//     return view('frontend.menus.faq', compact('faqs')); 
// }

// Example: HomeController.php
// public function mainFaq(Request $request)
// {
//     $categories = DB::table('faq_category')->get();

//     $faqs = DB::table('faqs1')
//         ->when($request->has('faq_category_id'), function ($query) use ($request) {
//             return $query->where('faq_category_id', $request->faq_category_id);
//         })
//         ->get();

//     return view('frontend.menus.faq', compact('faqs', 'categories'));
// }

public function mainFaq(Request $request)
{
    $categories = FaqCategory::where('status', 'active')->get();

    $faqs = Faq::when($request->faq_category_id, function ($query) use ($request) {
            return $query->where('faq_category_id', $request->faq_category_id);
        })
        ->where('status', 'active')
        ->get();

    return view('frontend.menus.faq', compact('faqs', 'categories'));
}

//-------------------------------------------------------

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
