<?php

namespace Modules\Location\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Location\App\Models\District;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
   if ($request->ajax()) {
        
        $query = District::with('states')->select('districts.*');

        
        return DataTables::eloquent($query)
            ->addIndexColumn() 
            ->editColumn('status', function ($district) {
                return ucfirst($district->status);
            })
            ->addColumn('state_name', function ($district) {
                return $district->states ? ucfirst($district->states->name) : 'N/A';
            })
            ->addColumn('action', function ($district) {
                return '
                    <div class="d-flex align-items-center nowrap">
                        <a href="' . route('districts.edit', $district->id) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil-square"></i></a>
                        <a href="' . route('districts.delete', $district->id) . '" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
                    </div>
                ';
            })
            ->rawColumns(['action']) // Allow raw HTML in the action column
            ->make(true); // Make the response DataTables compatible
    }
 
    return view('location::districts.index');
}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $states = State::all();
    return view('location::districts.create', compact('states'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'district_name' => 'required|string|max:255',
        'district_code' => 'nullable|string|max:50',
        'state_id'      => 'required',
        'status'        => 'required|in:Active,Inactive',
    ]);

    District::create($request->all());

    return redirect()->route('districts.index')->with('success', 'District created successfully.');
}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('location::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $district = District::findOrFail($id);
    $states = State::all();

    return view('location::districts.create', compact('district', 'states'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
{
    $request->validate([
        'district_name' => 'required|string|max:255',
        'district_code' => 'nullable|string|max:50',
        'state_id'      => 'required|exists:states,id',
        'status'        => 'required|in:Active,Inactive',
    ]);

    $district = District::findOrFail($id);
    $district->update($request->all());

    return redirect()->route('districts.index')->with('success', 'District updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
{
    $district = District::findOrFail($id);
    $district->delete();

    return redirect()->route('districts.index')->with('success', 'District deleted successfully.');
}

}
