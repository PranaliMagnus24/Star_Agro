<?php

namespace Modules\Members\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Members\App\Models\EnquiryWallet;
use Modules\Members\App\Models\EnquiryWalletTransaction;
use Modules\MasterSetting\App\Models\PaymentGateway;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class RechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('members::index');
    // }
    
    public function index()
    {
        $wallets = EnquiryWallet::where('user_id', auth()->id())->paginate(10);
        return view('members::wallet_management.index', compact('wallets'));
    }
    
    public function razorpay()
    {
        $razorpayGateway = PaymentGateway::where('payment', 'Razorpay')->first();
    
        if (!$razorpayGateway) {
            return redirect()->route('wallet.management.index')->with('error', 'Razorpay payment gateway not configured.');
        }
    
        $amountInRupees = 100;
        $amountInPaise = $amountInRupees * 100;
    
        $api = new Api($razorpayGateway->api_key, $razorpayGateway->secret_key);
    
        $order = $api->order->create([
            'amount' => $amountInPaise,
            'currency' => 'INR',
            'receipt' => 'receipt#' . uniqid(),
        ]);
    
        return view('frontend.razorpay.index', [
            'amount' => $amountInRupees,
            'razorpayKey' => $razorpayGateway->api_key,
            'userName' => Auth::user()->name,
        ]);
    }
    
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members::wallet_management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'wallet_name' => 'required|string|max:255',
        'balance' => 'required|numeric|min:0',

    ]);

    $user = auth()->user();
    $roleId = $user->roles->first()?->id;

    EnquiryWallet::create([
        'wallet_name' => $request->wallet_name,
        'balance'     => $request->balance,
        'user_id'     => auth()->id(),
        'role_id'     => $roleId, 
    ]);

    return redirect()->route('wallet.management.index')->with('success', 'Wallet created successfully.');
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
    public function makeEnquiry(Request $request)
{
    $user = auth()->user();

    DB::beginTransaction();

    try {
        $wallet = EnquiryWallet::where('user_id', $user->id)->firstOrFail();

        if ($wallet->balance < 10) {
            return back()->with('error', 'Insufficient points in your wallet.');
        }

        // Deduct points
        $wallet->balance -= 10;
        $wallet->save();

        // Log transaction
        EnquiryWalletTransaction::create([
            'wallet_id'   => $wallet->id,
            'enquiry_id'  => null, // or pass the created enquiry id if applicable
            'type'        => 'debit',
            'amount'      => 10,
            'description' => 'Deducted for crop enquiry',
        ]);


    DB::commit();

        return back()->with('success', 'Enquiry submitted and 10 points deducted.');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}
}