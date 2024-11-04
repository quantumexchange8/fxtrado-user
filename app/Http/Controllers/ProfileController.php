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

        $auth = Auth::user();
        $user = User::find($auth->id);

        if (!is_null($request->firstName) && $request->firstName !== '') {
            $user->name = $request->firstName;
        }

        

        if (!is_null($request->number) && $request->number !== '') {
            $user->phone_number = $request->number;
        }

        if (!is_null($request->email) && $request->email !== '') {
            $request->validate([
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            ]);

        }

        $user->save();

        return redirect()->route('profile');
    }

    public function updateSecurity(Request $request)
    {

        $auth = Auth::user();
        $user = User::find($auth->id);

        

        return redirect()->route('profile')->with('status', 'Security details updated successfully.');
    }
}
