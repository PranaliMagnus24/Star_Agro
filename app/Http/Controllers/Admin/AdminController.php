<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function adminIndex()
   {
      $yesCount = User::where('solar_dryer', 'yes')->count();
    return view('admin.index', compact('yesCount'));
   }
}
