<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{

    public function create()
    {
        return view('admin.location_picker.create');
    }
    public function store(Request $request)
{
    $request->validate([
        'location.latitude' => 'required',
        'location.longitude' => 'required',
    ]);

    Location::create([
        'latitude' => $request->input('location.latitude'),
        'longitude' => $request->input('location.longitude'),
        'address' => $request->input('address'),
    ]);

    return redirect()->route('locations.index')->with('success', 'Location added successfully');
}

public function update(Request $request, Location $location)
{
    $request->validate([
        'location.latitude' => 'required',
        'location.longitude' => 'required',
    ]);

    $location->update([
        'latitude' => $request->input('location.latitude'),
        'longitude' => $request->input('location.longitude'),
        'address' => $request->input('address'),
    ]);

    return redirect()->route('locations.index')->with('success', 'Location updated successfully');
}


public function destroy(Location $location)
{
    $location->delete();
    return redirect()->route('locations.index')->with('success', 'Location deleted successfully');
}

}
