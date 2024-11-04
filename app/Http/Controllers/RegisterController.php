<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Wallet;
use App\Services\RunningNumberService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {

        return view('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeRegister(RegisterRequest $request): RedirectResponse
    {
        // $request->validate([
        //     'fullName' => 'required|string|max:255',
        //     'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $user = User::create([
            'name' => $request->fullName,
            'email' => $request->email,
            'role' => 'member',
            'password' => Hash::make($request->password),
            'status' => 'unverify',
        ]);

        $wallet = Wallet::create([
            'user_id' => $user->id,
            'wallet_no' => RunningNumberService::getID('wallet'),
            'balance' => '0.00',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('forex_pair', absolute: false));

    }
}
