<?php

namespace App\Http\Controllers\Admin\QuantityMass;
use App\Http\Controllers\Controller;
use App\Models\QuantityMass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class QuantityMassController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $unitMasses = QuantityMass::query()->orderBy('name', 'asc');
            return DataTables::eloquent($unitMasses)
                ->addIndexColumn()
                ->editColumn('name', function($unitmass) {
                    return ucfirst($unitmass->name);
                })
               
                ->addColumn('action', function($unitmass) {
                    return '
                        <div class="d-flex align-items-center nowrap">
                            <a href="'.route('admin.quantityMass.edit', $unitmass->id).'" class="btn btn-primary me-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="'.route('admin.quantityMass.delete', $unitmass->id).'" class="btn btn-danger delete-confirm me-1"><i class="bi bi-trash3-fill"></i></a>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.quantity_mass.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quantity_mass.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new QuantityMass entry
        QuantityMass::create($request->all());

        return redirect()->route('admin.quantityMass.index')->with('success', 'Unit mass created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unitmass = QuantityMass::findOrFail($id);
        return view('admin.quantity_mass.edit', compact('unitmass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the QuantityMass entry and update it
        $unitmass = QuantityMass::findOrFail($id);
        $unitmass->update($request->all());

        return redirect()->route('admin.quantityMass.index')->with('success', 'Unit mass updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unitmass = QuantityMass::findOrFail($id);
        $unitmass->delete();

        return redirect()->route('admin.quantityMass.index')->with('success', 'Unit mass deleted successfully!');
    }    


}
