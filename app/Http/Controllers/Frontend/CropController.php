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
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\User;
use App\Models\FarmerDocument;
use App\Models\CropInquiry;
use App\Models\PointsSetting;
use App\Models\Favorite;
use Modules\Category\App\Models\Category;
use Modules\Members\App\Models\CropImages;
use Modules\Members\App\Models\CropManagement;


use Modules\Members\App\Models\EnquiryWallet;
use Modules\Members\App\Models\EnquiryWalletTransaction;
use Illuminate\Support\Facades\DB;
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
           // $query->where('parent_id', '>', 0)->where('subcategory_id', '>', 0);
            $query->where('subcategory_id', '>', 0);
        }

        if ($search) {
            $query->where('category_name', 'like', '%' . $search . '%');
        }

        $categories = $query->withCount('cropManagements')->orderBy('created_at', 'asc')->having('crop_managements_count', '>', 0)->paginate(12);

        return view('frontend.crops.crops', compact('categories'));
    }

    public function showCropManagementList($categoryId)
    {
        $cropManagements = CropManagement::with('images')->where('crop_id', $categoryId)->get();

        $cities = City::where('state_id', 4008)->get(['name', 'id']);

        foreach ($cropManagements as $cropManagement) {
            $cropManagement->formatted_planating_date = Carbon::parse($cropManagement->planating_date)->format('d F Y');
        }
        
        if (Auth::check()) {
            $userId = Auth::id();
            $role = Auth::user()->role; // Get the role of the authenticated user
        
            foreach ($cropManagements as $cropManagement) {
                if ($role === 'farmer') {
                    // For farmers, check if they've inquired for this crop
                    $cropManagement->hasInquired = CropInquiry::where('crop_management_id', $cropManagement->id)
                        ->whereHas('cropManagement', function($query) use ($userId) {
                            $query->where('farmer_id', $userId);
                        })->exists();
                } else {
                    // For non-farmers, allow them to inquire for crops as well
                    // Assuming non-farmers can inquire without any specific role check
                    $cropManagement->hasInquired = CropInquiry::where('crop_management_id', $cropManagement->id)
                        ->whereHas('cropManagement', function($query) use ($userId) {
                            $query->where('farmer_id', $userId);  
                        })->exists();
                }
            }
        } else {
            // If the user is not authenticated, set hasInquired to false for all crops
            foreach ($cropManagements as $cropManagement) {
                $cropManagement->hasInquired = false;
            }
        }
        
        $currentCategory = Category::find($categoryId);
        $relatedCategories = Category::where('parent_id', $currentCategory->parent_id)
            ->where('id', '!=', $categoryId)
            ->get();

        return view('frontend.crops.crops_list', compact('cropManagements', 'cities', 'relatedCategories', 'currentCategory'));
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
    public function checkBalance(Request $request)
{
    // Fetch crop management by crop_id or crop_management_id
    $cropId = $request->crop_id ?? $request->crop_management_id; 

    $cropManagement = CropManagement::find($cropId);

    if (!$cropManagement) {
        return response()->json([
            'success' => false,
            'message' => 'Crop management not found.'
        ]);
    }

    // Fetch user's wallet balance
    $user = auth()->user();
    $wallet = EnquiryWallet::where('user_id', $user->id)->first();

    if (!$wallet) {
        return response()->json([
            'success' => false,
            'message' => 'No wallet found for this user.'
        ]);
    }

    // Fetch expected price and user's wallet balance
    // $expectedPrice = (float) $cropManagement->expected_price;
    // $walletBalance = (float) $wallet->balance;

    // if ($expectedPrice > $walletBalance) {


     // Fetch  points_per_inquiry
      $PointsSetting = PointsSetting::first();
      $points_per_inquiry = PointsSetting::value('points_per_inquiry') ?? 0;
      
     // Fetch user's wallet balance
     $walletBalance = (float) $wallet->balance;
     if ($points_per_inquiry>$walletBalance) {
        return response()->json([
            'success' => false,
            'message' => 'Insufficient balance, please recharge.'
        ]);
    }

    return response()->json([
        'success' => true
    ]);
}


    public function cropInquiry(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|string',
            'mobile_number' => 'required|digits:10',
            'description' => 'required|string',
            'city' => 'required|string',
            'crop_management_id' => 'required',
            'crop_name' => 'required|string',
        ]);
        $user = auth()->user();
        if (!$user) {
            return back()->with('error', 'User not authenticated.');
        }
        // // Retrieve crop management details
        $cropManagement = CropManagement::find($request->crop_management_id);
        if (!$cropManagement) {
            return back()->with('error', 'Crop management not found.');
        }
        //  dd('Crop management found');

        
        // Get expected price
       // $expectedPrice = (float) $cropManagement->expected_price;
        //  dd($expectedPrice);

       // $wallet = EnquiryWallet::where('user_id', $user->id)->first();
        // dd($wallet);

       // if (!$wallet) {
        //     return back()->with('error', 'No wallet found for this user.');
       // }

        // $expectedPrice = (float) $cropManagement->expected_price;
        // $walletBalance = (float) $wallet->balance;

        // if ($expectedPrice > $walletBalance) {
        //     return back()->with('error', 'Insufficient balance, please recharge.');
        // }
        //  dd($expectedPrice);

        // Inquiry Create
        $cropInquiry = CropInquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'crop_management_id' => $request->crop_management_id,
            'city' => $request->city,
            'description' => $request->description,
            'crop_name' => $request->crop_name,
        ]);
        $enquiryId = $cropInquiry->id;
        // $user = auth()->user();
        // if (!$user) {
        //     return back()->with('error', 'User not authenticated.');
        // }
            // Fetch the dynamic points deduction value
            $pointsSetting = PointsSetting::first();
            $pointsToDeduct = $pointsSetting ? $pointsSetting->points_per_inquiry : 10; // Fallback to 10 if not set

                 $wallet = EnquiryWallet::where('user_id', $user->id)->first();
         if (!$wallet) {
           return ['success' => false, 'message' => 'No wallet found for this user.'];
        }

        // Deduct points
       
        $pointsDeduction = $this->deductPoints($user->id, $pointsToDeduct, $enquiryId);
      // dd($pointsDeduction);


        if (!$pointsDeduction['success']) {
            return back()->with('error', $pointsDeduction['message']);
        }

        $cityName = City::where('id', $request->city)->value('name');
        // Crop Owner Data
        $cropOwner = CropManagement::where('id', $request->crop_management_id)
            ->with('user')
            ->first();

        $ownerName = $cropOwner->user->name ?? 'N/A';
        $ownerPhone = $cropOwner->user->phone ?? 'N/A';
        $ownerEmail = $cropOwner->user->email ?? 'N/A';

        $message = "New Crop Inquiry Received!\n\n" . "👤 Name: {$request->name}\n" . "📞 Phone: {$request->mobile_number}\n" . "📍 City: $cityName\n" . "🌾 Crop Name: {$request->crop_name}\n" . "💬 Description: {$request->description}\n";

        $this->sendWhatsAppMessage($ownerPhone, $message);

        $confirmationMessage = "Thank you for your Crop inquiry!\n\n" . "📝 Details:\n" . "🌾 Crop Name: {$request->crop_name}\n" . "📍 City: $cityName\n" . "💬 Description: {$request->description}\n\n" . "📢 Crop Owner Details:\n" . "👤 Name: $ownerName\n" . "📞 Phone: $ownerPhone\n" . "✉️ Email: $ownerEmail";

        $this->sendWhatsAppMessage($request->mobile_number, $confirmationMessage);

         // Set expected price to 0 after successful inquiry and message sending
        //  $cropManagement->expected_price = 0;
        //  $cropManagement->save();

        return redirect()->back()->with('success', 'Inquiry Message Sent Successfully');
    }
    
    private function deductPoints($userId, $amount,$enquiryId)
    {
        DB::beginTransaction();
        try {
            $wallet = EnquiryWallet::where('user_id', $userId)->firstOrFail();

            if ($wallet->balance < $amount) {
                return ['success' => false, 'message' => 'Insufficient wallet balance.'];
            }

            $wallet->balance = (string) ((float)$wallet->balance - (float)$amount);

            // $newBalance = (float)$wallet->balance - (float)$amount;
            // $wallet->balance = (string) $newBalance;
    
             //dd('saving...', $wallet);
            $wallet->save();

        //   dd($wallet->id, $enquiryId);

            EnquiryWalletTransaction::create([
                'wallet_id' => $wallet->id,
                'enquiry_id' => $enquiryId,
                'type' => 'debit',
                'amount' => $amount,
                'description' => 'Deducted for crop inquiry',
            ]);

            // dd($wallet->id);

            DB::commit();
            return ['success' => true, 'message' => 'Points deducted successfully.'];
             // Set session values
       

        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    public function showDetails($id)
    {
        // Fetch the crop inquiry details
        $cropsInquiry = CropInquiry::find($id);
        dd($cropsInquiry);
        
        // Pass the data to the view
        return view('crop.details', compact('cropsInquiry'));
    }
    

    private function sendWhatsAppMessage($mobile, $message)
    {
        $apiKey = 'e1a8324cf39a475499b5179b83b4d481';
        $apiUrl = 'https://whatsappnew.bestsms.co.in/wapp/v2/api/send';

        $postData = [
            'apikey' => $apiKey,
            'mobile' => $mobile,
            'msg' => $message,
        ];

        $headers = ['Content-Type: application/x-www-form-urlencoded'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            \Log::error('WhatsApp API Curl error: ' . curl_error($ch));
            return 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);

        return $response;
        
    }
    public function showCropDetails($id): Factory|View
    {
        $userId = Auth::id(); 
        // $cropManagement = CropManagement::with(['user', 'inquiries'])->findOrFail($id);
        $cropManagement = CropManagement::with(['inquiries.walletTransactions'])
        ->where('id',  $id)
        ->where('farmer_id', $userId) 
        ->firstOrFail();
    
        return view('frontend.crops.details', compact('cropManagement'));
    }

    

    // public function cropInquiry(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'nullable|string',
    //         'mobile_number' => 'required|digits:10',
    //         'description' => 'required|string',
    //         'city' => 'required|string',
    //         'crop_management_id' => 'required',
    //         'crop_name' => 'required|string',
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

    //     $cropOwner = CropManagement::where('id', $request->crop_management_id)->with('user')->first();

    //     $ownerName = $cropOwner->user->name ?? "N/A";
    //     $ownerPhone = $cropOwner->user->phone ?? "N/A";
    //     $ownerEmail = $cropOwner->user->email ?? "N/A";

    //     $this->sendWhatsAppMessage(
    //         $ownerPhone,
    //         "New Inquiry Received:\n" .
    //         "Sender Name: {$request->name}\n" .
    //         "Sender Phone: {$request->mobile_number}\n" .
    //         "Sender Email: " . ($request->email ?? 'N/A') . "\n" .
    //         "City: {$request->city}\n" .
    //         "Crop Name: {$request->crop_name}\n" .
    //         "Description: {$request->description}"
    //     );

    //     $message = "New Inquiry Received!\n\n"
    //     . "👤 Name: {$request->name}\n"
    //     . "📞 Phone: {$request->mobile_number}\n"
    //     . "💬 Message: {$request->description}\n\n"
    //     . "🔗 Crop Name: $crop_name\n";

    // $response = $this->sendWhatsAppMessage($shopOwnerPhone, $message);

    //     return redirect()->back()->with('success', 'Inquiry Message Sent Successfully');
    // }

    // private function sendWhatsAppMessage($receiverPhone, $messageBody)
    // {
    //     $apiKey = 'df5e79c175c64474aab517d02b6d9d34';
    //     $apiUrl = 'https://whatsappnew.bestsms.co.in/wapp/v2/api/send';

    //     $messageData = [
    //         'to' => $receiverPhone,
    //         'message' => [
    //             'body' => $messageBody
    //         ]
    //     ];

    //     $headers = [
    //         'Content-Type: application/json',
    //         'Authorization: Bearer ' . $apiKey,
    //     ];

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $apiUrl);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));

    //     $response = curl_exec($ch);
    //     dd($response);

    //     if (curl_errno($ch)) {
    //         \Log::error("WhatsApp API Curl error: " . curl_error($ch));
    //         return "Curl error: " . curl_error($ch);
    //     }

    //     curl_close($ch);

    //     \Log::info("WhatsApp API Response: " . $response);
    //     return $response;
    // }

    //     private function sendWhatsAppMessage($mobile, $message)
    // {
    //     $apiKey = "8d6b516d798e44898545437d239e71e1";
    //     $apiUrl = "https://whatsappnew.bestsms.co.in/wapp/v2/api/send";

    //     $postData = [
    //         'apikey' => $apiKey,
    //         'mobile' => $mobile,
    //         'msg' => $message,
    //     ];

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $apiUrl);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    //     $response = curl_exec($ch);

    //     if (curl_errno($ch)) {
    //         \Log::error("WhatsApp API Curl error: " . curl_error($ch));
    //         return "Curl error: " . curl_error($ch);
    //     }

    //     curl_close($ch);

    //     return $response;
    // }

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
