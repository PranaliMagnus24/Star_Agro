<?php

namespace Modules\Location\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Location\App\Models\District;
use Modules\Location\App\Models\Taluka;
use Yajra\DataTables\Facades\DataTables;


class TalukaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
         if ($request->ajax()) {
        $query = Taluka::with('district')->select('talukas.*');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($taluka) {
                return ucfirst($taluka->status);
            })
            ->addColumn('district_name', function ($taluka) {
                return $taluka->district->district_name ?? '-';
            })
            ->addColumn('action', function ($taluka) {
                return '
                    <div class="d-flex align-items-center nowrap">
                        <a href="' . route('talukas.edit', $taluka->id) . '" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil-square"></i></a>
                        <a href="' . route('talukas.delete', $taluka->id) . '"class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

        return view('location::talukas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $districts = District::all();
        return view('location::talukas.create',compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'taluka_name' => 'required',
            'taluka_code' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'status' => 'required|in:Active,Inactive',
        ]);

        Taluka::create($request->all());

        return redirect()->route('talukas.index')->with('success', 'Taluka created successfully.');
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
        $taluka = Taluka::findOrFail($id);
        $districts=District::all();
        return view('location::talukas.create', compact('taluka','districts'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $taluka = Taluka::findOrFail($id);
        $taluka->update($request->all());

        return redirect()->route('talukas.index')->with('success', 'Taluka updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $taluka = Taluka::findOrFail($id);
        $taluka->delete();
        return redirect()->route('talukas.index')->with('success', 'Taluka deleted successfully');
    }

     
}
