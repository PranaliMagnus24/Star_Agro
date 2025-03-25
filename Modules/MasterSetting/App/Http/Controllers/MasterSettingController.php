<?php

namespace Modules\MasterSetting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MasterSetting\App\Models\PaymentGateway;
use Modules\MasterSetting\App\Models\Whatsapp;
use Modules\MasterSetting\App\Models\SMSGateway;

class MasterSettingController extends Controller
{
   ///Whatsapp list
   public function index(Request $request)
   {
       $search = $request->input('search');

       $whatsapps = Whatsapp::when($search, function ($query) use ($search) {
           return $query->where('api_key', 'LIKE', "%{$search}%");
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

    // Add this method to your controller
    public function edit($id)
    {
        return $this->create($id);
    }

    ////whatsapp store
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'api_key' => 'required|string',
            'status' => 'nullable|string',
           ]);

           $whatsapp = new Whatsapp();
           $whatsapp->api_key = $request->api_key;
           $whatsapp->status = $request->status;
           $whatsapp->save();
           return redirect()->route('whatsapp.index')->with('success','Whatsapp Settings created successfully!');
    }


/////whatsapp update
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'api_key' => 'required|string',
            'status' => 'nullable|string',
        ]);

        $whatsapp = Whatsapp::findOrFail($id);
        $whatsapp->api_key = $request->api_key;
        $whatsapp->status = $request->status;
        $whatsapp->save();

        return redirect()->route('whatsapp.index')->with('success', 'Whatsapp Settings updated successfully!');
    }

////whatsapp delete
    public function destroy($id)
    {
        $whatsapp = Whatsapp::findOrFail($id);
        $whatsapp->delete();

    return redirect()->route('whatsapp.index')->with('success', 'Whatsapp Settings deleted successfully!');
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


///////SMS Gateway
    public function smsList(Request $request)
    {
        $search = $request->input('search');

        $datas = SMSGateway::when($search, function ($query) use ($search) {
            return $query->where('api_key', 'LIKE', "%{$search}%");
        })->paginate(20);

        return view('mastersetting::sms.index', compact('datas'));
    }

    public function smsCreate($id = null)
    {
        $data = null;
        if ($id) {
            $data = SMSGateway::findOrFail($id);
        }
        return view('mastersetting::sms.create', compact('data'));
    }


    public function storeSms(Request $request)
    {
        $request->validate([
         'api_key' => 'required|string',
         'status' => 'nullable|string',
        ]);

        $data = new SMSGateway();
        $data->api_key = $request->api_key;
        $data->status = $request->status;
        $data->save();
        return redirect()->route('sms.index')->with('success','SMS Gateway created successfully!');
    }

    public function updateSms(Request $request, $id)
    {
        $request->validate([
            'api_key' => 'required|string',
            'status' => 'nullable|string',
        ]);

        $payment = SMSGateway::findOrFail($id);
        $payment->api_key = $request->api_key;
        $payment->status = $request->status;
        $payment->save();

        return redirect()->route('sms.index')->with('success', 'SMS Gateway updated successfully!');
    }


    public function destroySms($id)
    {
        $data = SMSGateway::findOrFail($id);
        $data->delete();

        return redirect()->route('sms.index')->with('success', 'SMS Gateway deleted successfully!');
    }

}
