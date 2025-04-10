<?php

namespace App\Http\Controllers\Admin\QuantityMass;
use App\Http\Controllers\Controller;
use App\Models\QuantityMass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class QuantityMassController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QuantityMass::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        $unitMasses = $query->paginate(10); // Adjust the pagination as needed

        return view('admin.quantity_mass.index', compact('unitMasses'));
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
