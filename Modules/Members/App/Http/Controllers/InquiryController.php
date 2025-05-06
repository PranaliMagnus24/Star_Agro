<?php

namespace Modules\Members\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CropInquiry;
use App\Models\User;
use Illuminate\Http\Response;
use App\Models\State; // Assuming you have a State model
use App\Models\City; 

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        
        $userEmail = Auth::user()->email;
    
        $inquiries = CropInquiry::with(['walletTransactions', 'cropManagement.farmer'])
            ->where('email', $userEmail)
            ->paginate(10);
            // dd($inquiries);
       
        $cropManagement = CropInquiry::with('walletTransactions')
            ->where('email', $userEmail)
            ->get(); 
    
              // Fetch states and districts for mapping
        $states = State::pluck('name', 'id')->toArray();
            $City = City::pluck('name', 'id')->toArray();
        
        return view('members::inquiry_management.index', compact('inquiries', 'cropManagement'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
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
}
