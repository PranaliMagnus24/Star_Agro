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

class HomeController extends Controller
{
    public function mainIndex()
    {
        return view('frontend.menus.home');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $crop = CropManagement::where('crop_name', 'like', "%{$query}%")->first();
        if ($crop) {
            return redirect()->route('crop.management.list', $crop->id);
        }

        $category = Category::where('category_name', 'like', "%{$query}%")->first();
        if($category){
            return redirect()->route('home.crops', $category->id);
        }

        return back()->with('error', 'No results found.');
    }


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
