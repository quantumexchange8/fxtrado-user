<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {

        return view('Profile/Profile');
    }

    public function updateProfile(Request $request)
    {

        // dd($request->all());

        return redirect()->back();
    }

    public function updateSecurity(Request $request)
    {

        // dd($request->all());

        return redirect()->back();
    }
}
