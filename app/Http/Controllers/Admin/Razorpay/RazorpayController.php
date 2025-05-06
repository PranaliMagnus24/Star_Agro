<?php

namespace App\Http\Controllers\Admin\Razorpay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RazorpayPayment;
use Razorpay\Api\Api;
use Modules\Members\App\Models\EnquiryWallet;
use Modules\MasterSetting\App\Models\PaymentGateway;
use Modules\Members\App\Models\Wallet; 
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayController extends Controller
{
    public function index(Request $request)
    {
        $razorpayGateway = PaymentGateway::where('payment', 'Razorpay')->first();

        if (!$razorpayGateway) {
            return redirect()->back()->with('error', 'Razorpay payment gateway not configured.');
        }

        // Set a default or session-based amount here (in rupees)
        $amountInRupees = 100; // Example: ₹100
        $amountInPaise = $amountInRupees * 100;

        $api = new Api($razorpayGateway->api_key, $razorpayGateway->secret_key);

        $order = $api->order->create([
            'amount' => $amountInPaise,
            'currency' => 'INR',
            'receipt' => 'receipt#' . uniqid(),
        ]);

        return view('frontend.razorpay.index', [
            'amount' => $amountInRupees,
            'orderId' => $order['id'],
            'razorpayKey' => $razorpayGateway->api_key,
            'userName' => Auth::user()->name, 
        ]);
    }
    public function createOrder(Request $request)
{
    
    $request->validate([
        'amount' => 'required|numeric|min:100',
    ]);

    $razorpayGateway = PaymentGateway::where('payment', 'Razorpay')->first();

    if (!$razorpayGateway) {
        return redirect()->back()->with('error', 'Razorpay payment gateway not configured.');
    }

    $api = new Api($razorpayGateway->api_key, $razorpayGateway->secret_key);
    $amountInPaise = $request->amount * 100;

    $order = $api->order->create([
        'amount' => $amountInPaise,
        'currency' => 'INR',
        'receipt' => 'receipt#' . uniqid(),
    ]);

    // return view('frontend.razorpay.index', [
    //     'amount' => $request->amount,
    //     'orderId' => $order['id'],
    //     'razorpayKey' => $razorpayGateway->api_key,
    // ]);

    return response()->json([
        'orderId' => $order->id,
    
    ]);
}


    public function payment(Request $request)
    {
        // This method can be used to handle additional payment processing if needed
    }

    public function verifyPayment(Request $request)
    {
   
        $razorpayGateway = PaymentGateway::where('payment', 'Razorpay')->first();

        if (!$razorpayGateway) {
            return redirect()->back()->with('error', 'Razorpay payment gateway not configured.');
        }

        $api = new Api($razorpayGateway->api_key, $razorpayGateway->secret_key);

        // try {
        //      // Signature verification
        //     $attributes = [
        //         'razorpay_order_id' => $request->razorpay_order_id,
        //         'razorpay_payment_id' => $request->razorpay_payment_id,
        //         'razorpay_signature' => $request->razorpay_signature
        //     ];


        //     $api->utility->verifyPaymentSignature($attributes);
        // } catch (SignatureVerificationError $e) {
        //     return back()->with('error', 'Payment signature verification failed.');
        // }

        // Store payment details
        $payment =  RazorpayPayment::create([
            'user_id' => Auth::id(),
            'order_id' => $request->razorpay_order_id,
            'payment_id' => $request->razorpay_payment_id,
            'signature' => $request->razorpay_signature,
            'amount' => $request->amount,
            'status' => 'paid',
            'payment_date' => now(),
        ]);

       // return redirect()->back()->with('success', 'Payment Successful!');
       $wallet = EnquiryWallet::where('user_id', Auth::id())->first();
       if ($wallet) {
           $wallet->balance += $request->amount;
           $wallet->save();
       }
   
       return redirect()->back()->with('success', '₹' . $request->amount . ' has been added to your wallet.');
    }
    
}
