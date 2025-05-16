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
use Yajra\DataTables\DataTables;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // { 
        
    //     $userEmail = Auth::user()->email;
    
    //     $inquiries = CropInquiry::with(['walletTransactions', 'cropManagement.farmer'])
    //         ->where('email', $userEmail)
    //         ->paginate(12);
    //         // dd($inquiries);
       
    //     $cropManagement = CropInquiry::with('walletTransactions')
    //         ->where('email', $userEmail)
    //         ->get(); 
    
    //           // Fetch states and districts for mapping
    //     $states = State::pluck('name', 'id')->toArray();
    //         $City = City::pluck('name', 'id')->toArray();
        
    //     return view('members::inquiry_management.index', compact('inquiries', 'cropManagement','states', 'City'));
    // }
    public function index(Request $request)
{
    $states = State::pluck('name', 'id')->toArray();
    $cities = City::pluck('name', 'id')->toArray();
    $userEmail = Auth::user()->email;

    if ($request->ajax()) {
        // Fetch inquiries ordered by 'created_at' in descending order (most recent first)
        $inquiries = CropInquiry::with(['cropManagement.farmer', 'walletTransactions'])
            ->where('email', $userEmail)
            ->orderBy('created_at', 'desc'); // Ensure the latest inquiries come first

        return DataTables::of($inquiries)
            ->addColumn('id', function ($row) {
                return $row->getKey(); // Automatically use the primary key
            })
            ->addColumn('crop_name', fn($row) => $row->cropManagement->crop_name ?? 'N/A')
            ->addColumn('farmer_name', fn($row) => $row->cropManagement->farmer->name ?? 'N/A')
            ->addColumn('mobile', fn($row) => $row->cropManagement->farmer->phone ?? 'N/A')
            ->addColumn('email', fn($row) => $row->cropManagement->farmer->email ?? 'N/A')
            ->addColumn('city', function ($row) use ($states, $cities) {
                $farmer = $row->cropManagement->farmer ?? null;
                return ($farmer->town ?? 'Unknown Town');
            })
            ->addColumn('date', fn($row) => $row->created_at->format('d M Y'))
           ->addColumn('wallet', function ($row) {
    if ($row->walletTransactions->count()) {
        $html = '<table class="table table-sm table-bordered text-center mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($row->walletTransactions as $transaction) {
            $html .= '<tr>
                        <td>' . ucfirst($transaction->type) . '</td>
                        <td>' . $transaction->amount . '</td>
                        <td>' . $transaction->description . '</td>
                        <td>' . \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') . '</td>
                      </tr>';
        }
        $html .= '</tbody></table>';
        return $html;
    } else {
        return '<p class="text-muted">No wallet transactions available.</p>';
    }
})


            ->rawColumns(['wallet']) // important to render HTML
            ->make(true);
    }

    return view('members::inquiry_management.index');
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