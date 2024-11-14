<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('Profile/Profile', [
            'user' => $user,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|unique:users,phone_number,' . Auth::id(),
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone,
            'email' => $request->email,
        ]);


        return redirect()->back();
    }

    public function updateSecurity(Request $request)
    {

        $auth = Auth::user();
        $user = User::find($auth->id);

        

        return redirect()->route('profile')->with('status', 'Security details updated successfully.');
    }
}
