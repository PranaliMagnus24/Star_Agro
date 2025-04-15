<?php

namespace App\Http\Controllers\Admin\FarmerRegistration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\App\Models\Category;
use App\Models\User;
use App\Models\FarmerDocuments;
use Spatie\Permission\Models\Role;
use Modules\Members\App\Models\CropImages;
use Modules\Members\App\Models\CropManagement;

class FarmerRegistrationController extends Controller
{
    public function farmerIndex(Request $request)
{
    $search = $request->input('search');
    $solarDryer = $request->input('solar_dryer');

    $users = User::role('farmer')
        ->when($search, function ($query) use ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('solar_dryer', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        })
        ->when($solarDryer, function ($query) use ($solarDryer) {
            return $query->where('solar_dryer', $solarDryer);
        })
        ->orderBy('created_at','asc')
        ->paginate(10);

        // Count farmers with solar dryer set to 'yes'
        $yesCount = User::role('farmer')->where('solar_dryer', 'yes')->count();

        return view('admin.farmer_registration.farmer_index', compact('users', 'yesCount'));

}
 public function farmerEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.farmer_registration.farmer_edit', compact('user'));

    }

    // upadate
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'phone' => 'required|string|max:15',
        'solar_dryer' => 'required|string',
        'documents.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);


    $user = User::findOrFail($id);

    
    $user->update($validatedData);

    
    $filePaths = []; 

    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $file) {
            // Store each file
            $path = $file->store('farmer_documents/' . $user->id, 'public');
            $filePaths[] = $path; 
        }
    }

    
    $user->farmerDocuments()->updateOrCreate(
        ['user_id' => $user->id],
        ['file_paths' => implode(',', $filePaths), 'is_verified' => false] // Store as comma-separated
    );

    
    return redirect()->route('admin.farmer.index')->with('success', 'Farmer updated successfully.');
}
    public function farmerDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.farmer.index')->with('success', 'Farmer deleted successfully.');
    }

    public function verifyDocument($id)
    {
        $document = FarmerDocuments::findOrFail($id);
        $document->is_verified = true;
        $document->save();
    
        return redirect()->back()->with('success', 'Document verified successfully.');
    }
    


public function entrepreneurIndex(Request $request)
{
    $search = $request->input('search');

    $users = User::role('entrepreneur')
        ->when($search, function ($query) use ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        })
        ->orderBy('created_at','asc')
        ->paginate(10);

    return view('admin.entrepreneur.index', compact('users'));
}
// trader

public function traderIndex(Request $request)
{
    $search = $request->input('search');

    $users = User::role('trader')
        ->when($search, function ($query) use ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        })
        ->orderBy('created_at','asc')
        ->paginate(10);

    return view('admin.trader.index', compact('users'));
}

}
