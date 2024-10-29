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

        if (!is_null($request->lastName) && $request->lastName !== '') {
            $user->last_name = $request->lastName;
        }

        if (!is_null($request->email) && $request->email !== '') {
            $request->validate([
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            ]);
            
            $user->email = $request->email;
        }

        if (!is_null($request->number) && $request->number !== '') {
            $user->phone_number = $request->number;
        }

        if (!is_null($request->address) && $request->address !== '') {
            $user->address = $request->address;
        }

        if (!is_null($request->city) && $request->city !== '') {
            $user->city = $request->city;
        }

        if (!is_null($request->state) && $request->state !== '') {
            $user->state = $request->state;
        }

        if (!is_null($request->zipCode) && $request->zipCode !== '') {
            $user->zip = $request->zipCode;
        }

        if (!is_null($request->country) && $request->country !== '') {
            $user->country = $request->country;
        }

        $user->save();

        if ($request->verifyAcc === 'verifyUser') {
            $user->sendEmailVerificationNotification();

            return Redirect::back()->with('message', 'Verification email has been sent.');
        }

        return redirect()->route('profile');
    }

    public function updateSecurity(Request $request)
    {

        $auth = Auth::user();
        $user = User::find($auth->id);

        $request->validate([
            'currentPassword' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'], // 'confirmed' ensures password and confirmPassword match
        ], [
            // Custom error messages (optional)
            'currentPassword.required' => 'Please provide your current password.',
            'password.required' => 'Please provide a new password.',
            'password.confirmed' => 'The new password and confirm password do not match.',
            'password.min' => 'The new password must be at least 8 characters.',
        ]);

        if (!Hash::check($request->currentPassword, $user->password)) {
            if ($request->ajax()) {
                return response()->json(['errors' => ['currentPassword' => ['The current password is incorrect.']]], 422);
            }
            return redirect()->back()->withErrors(['currentPassword' => ['The current password is incorrect.']]);
        }

        $user->secure_question = $request->securityOne;
        $user->response = $request->securityAnsOne;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->ajax()) {
            return response()->json(['status' => 'Security details updated successfully.']);
        }

        return redirect()->route('profile')->with('status', 'Security details updated successfully.');
    }
}
