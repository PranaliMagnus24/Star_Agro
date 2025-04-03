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
use App\Models\CropInquiry;
use App\Models\Favorite;
use Modules\Category\App\Models\Category;
use Modules\Members\App\Models\CropImages;
use Modules\Members\App\Models\CropManagement;
use Str;
use File;
use Carbon\Carbon;

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

        $categories = $query->withCount('cropManagements')->having('crop_managements_count', '>', 0)->paginate(12);

        return view('frontend.crops.crops', compact('categories'));
    }


    public function showCropManagementList($categoryId)
    {
        $cropManagements = CropManagement::with('images')->where('crop_id', $categoryId)->get();
        $cities = City::where('state_id',4008)->get(["name", "id"]);
        foreach ($cropManagements as $cropManagement) {
            $cropManagement->formatted_planating_date = Carbon::parse($cropManagement->planating_date)->format('d F Y');
        }

        return view('frontend.crops.crops_list', compact('cropManagements','cities'));
    }



    // public function cropInquiry(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'nullable|string',
    //         'mobile_number' => 'required|integer|digits:10',
    //         'description' => 'required|string',
    //     ]);

    //     $cropInquiry = CropInquiry::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'mobile_number' => $request->mobile_number,
    //         'crop_management_id' => $request->crop_management_id,
    //         'city' => $request->city,
    //         'description' => $request->description,
    //         'crop_name' => $request->crop_name,
    //     ]);

    //     return redirect()->back()->with('success', 'Inquiry Message Send Successfully');


    // }


    public function cropInquiry(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'nullable|string',
        'mobile_number' => 'required|integer|digits:10',
        'description' => 'required|string',
        'city' => 'required|string',
        'crop_management_id' => 'required',
        'crop_name' => 'required|string',
    ]);

    // Create the inquiry
    $cropInquiry = CropInquiry::create([
        'name' => $request->name,
        'email' => $request->email,
        'mobile_number' => $request->mobile_number,
        'crop_management_id' => $request->crop_management_id,
        'city' => $request->city,
        'description' => $request->description,
        'crop_name' => $request->crop_name,
    ]);

    // Send WhatsApp message
    $this->sendWhatsAppMessage($request->mobile_number, $request->crop_name, $request->city, $request->description);

    return redirect()->back()->with('success', 'Inquiry Message Sent Successfully');
}

private function sendWhatsAppMessage($phoneNumber, $cropName, $city, $description)
{
    $apiKey = '7f18d32242b34bbdbdf904009195fa86';
    $url = 'https://whatsappnew.bestsms.co.in/wapp/v2/api/send';

    // Prepare the message data
    $messageData = [
        'to' => $phoneNumber,
        'message' => [
            'body' => "New Crop Inquiry:\n" .
                      "Crop Name: $cropName\n" .
                      "City: $city\n" .
                      "Contact Number: $phoneNumber\n" .
                       "Description: $description"
        ]
    ];

    // Send the message using cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        \Log::error('WhatsApp message failed: ' . curl_error($ch));
    } else {
        $responseData = json_decode($response, true);
        if (isset($responseData['error'])) {
            \Log::error('WhatsApp API error: ' . $responseData['error']);
        }
    }
    curl_close($ch);
}

/////Wishlist
    public function add(Request $request)
{
    \Log::info($request->all());

    $request->validate([
        'crop_management_id' => 'required',
    ]);

    Favorite::create([
        'user_id' => auth()->id(),
        'crop_management_id' => $request->crop_management_id,
    ]);

    return response()->json(['success' => true]);
}

/////Remove wishlist
    public function remove(Request $request)
    {
        $request->validate([
            'crop_management_id' => 'required',
        ]);

        Favorite::where('user_id', auth()->id())
            ->where('crop_management_id', $request->crop_management_id)
            ->delete();

        return response()->json(['success' => true]);
    }


}
