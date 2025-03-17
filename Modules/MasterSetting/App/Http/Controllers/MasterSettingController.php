<?php

namespace Modules\MasterSetting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterSetting\App\Models\PaymentGateway;
use Modules\MasterSetting\App\Models\Whatsapp;


class MasterSettingController extends Controller
{
   ///Whatsapp list
    public function index()
    {
        $search = $request->input('search');
        $whatsapps = Whatsapp::when($search, function ($query) use ($search) {
            return $query->where('api_key', 'like', "%{$search}%")
                         ->orWhere('secret_key', 'like', "%{$search}%");
        })->paginate(20);
        return view('mastersetting::whatsapp.index', compact('whatsapps'));
    }

/////Whatsapp create and edit page
    public function create($id = null)
    {
        $whatsapp = null;
        if ($id) {
            $whatsapp = Whatsapp::findOrFail($id);
        }
        return view('mastersetting::whatsapp.create', compact('whatsapp'));
    }

    ////whatsapp store
    public function store(Request $request): RedirectResponse
    {
        //
    }


/////whatsapp update
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

////whatsapp delete
    public function destroy($id)
    {
        //
    }



    /////Payment Gateway list
    public function paymentGatewaylist(Request $request)
    {
        $search = $request->input('search');
        $payments = PaymentGateway::when($search, function ($query) use ($search) {
            return $query->where('api_key', 'like', "%{$search}%")
                         ->orWhere('secret_key', 'like', "%{$search}%");
        })->paginate(20);

        return view('mastersetting::payment_gateway.index', compact('payments'));
    }

    ////Payment gateway add and edit page
    public function paymentGateway($id = null)
    {
        $payment = null;
        if ($id) {
            $payment = PaymentGateway::findOrFail($id);
        }
        return view('mastersetting::payment_gateway.create', compact('payment'));
    }

    /////Store payment gateway
    public function storePaymentGateway(Request $request)
    {
        $request->validate([
         'api_key' => 'required|string',
         'secret_key' => 'required|string',
         'payment' => 'required|string',
         'status' => 'nullable|string',
        ]);

        $payment = new PaymentGateway();
        $payment->api_key = $request->api_key;
        $payment->secret_key = $request->secret_key;
        $payment->payment = $request->payment;
        $payment->status = $request->status;
        $payment->save();
        return redirect()->route('paymentGateway.list')->with('success','Payment Gateway Method created successfully!');
    }

    ///Update payment gateway
    public function updatePaymentGateway(Request $request, $id)
    {
        $request->validate([
            'api_key' => 'required|string',
            'secret_key' => 'required|string',
            'payment' => 'required|string',
            'status' => 'nullable|string',
        ]);

        $payment = PaymentGateway::findOrFail($id);
        $payment->api_key = $request->api_key;
        $payment->secret_key = $request->secret_key;
        $payment->payment = $request->payment;
        $payment->status = $request->status;
        $payment->save();

        return redirect()->route('paymentGateway.list')->with('success', 'Payment Gateway Method updated successfully!');
    }

    ////delete payment gateway
    public function destroyPaymentGateway($id)
{
    $payment = PaymentGateway::findOrFail($id);
    $payment->delete();

    return redirect()->route('paymentGateway.list')->with('success', 'Payment Gateway Method deleted successfully!');
}

}
