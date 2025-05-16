<?php

namespace Modules\Location\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Location\App\Models\Taluka;
use Modules\Location\App\Models\Village;
use Yajra\DataTables\Facades\DataTables;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    if ($request->ajax()) {
        $villages = Village::with('taluka')->select('villages.*');
        return DataTables::of($villages)
            ->addColumn('taluka_name', function ($village) {
                return $village->taluka->taluka_name ?? '-';
            })
            ->addColumn('action', function ($village) {
                $edit = '<a href="' . route('villages.edit', $village->id) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil-square"></i></a>';
                $delete = '<a href="' . route('villages.delete', $village->id) . '" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>';
                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
        return view('location::villages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $talukas = Taluka::all();
        return view('location::villages.create', compact('talukas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'taluka_id' => 'required|exists:talukas,id',
            'village_code' => 'required|integer',
            'village_name' => 'nullable|string|max:255',
            'village_status' => 'nullable|in:Inhabitant,Un-Inhabitant',
            'village_category' => 'nullable|in:Rural,Urban',
            'status' => 'required|in:Active,Inactive',
        ]);
             Village::create($request->all());

        return redirect()->route('villages.index')->with('success', 'Village added successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
      $village = Village::findOrFail($id);
        return view('location::villages.show', compact('village'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $village = Village::findOrFail($id);
        $talukas = Taluka::all();
        return view('location::villages.edit', compact('village', 'talukas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'taluka_id' => 'required|exists:talukas,id',
            'village_code' => 'required|integer',
            'village_name' => 'nullable|string|max:255',
            'village_status' => 'nullable|in:Inhabitant,Un-Inhabitant',
            'village_category' => 'nullable|in:Rural,Urban',
            'status' => 'required|in:Active,Inactive',
        ]);

        $village = Village::findOrFail($id);
        $village->update($request->all());

        return redirect()->route('villages.index')->with('success', 'Village updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         Village::findOrFail($id)->delete();
        return redirect()->route('villages.index')->with('success', 'Village deleted successfully.');
    }
   

}
