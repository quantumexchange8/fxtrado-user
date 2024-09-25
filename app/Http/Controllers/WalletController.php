<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Services\RunningNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public function wallet()
    {

        return view('Wallets/Wallet');
    }

    public function deposit(Request $request)
    {
        $user = Auth::user();
        $wallet = Wallet::where('user_id', $user->id)->first();
        $transaction_id = RunningNumberService::getID('transaction');
        $token = Str::random(40);

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'transaction_number' => $transaction_id,
            'transaction_type' => 'Deposit',
            'status' => 'Processing',
        ]);

        $payoutSetting = config('payment-gateway');
        $domain = $_SERVER['HTTP_HOST'];
        $paymentGateway = config('payment-gateway');

        $selectedPayout = $payoutSetting['staging'];

        $vCode = md5($selectedPayout['appId'] . $transaction_id . $selectedPayout['merchantId'] . $selectedPayout['ttKey']);

        $params = [
            'orderNumber' => $transaction_id,
            'userId' => $user->id,
            'merchantId' => $selectedPayout['merchantId'],
            'vCode' => $vCode,
            'token' => $token,
            'userName' => $user->name,
            'userEmail' => $user->email,
            'locale' => $selectedPayout['language'],
        ];

        $url = $selectedPayout['paymentUrl'] . '/payment';
        $redirectUrl = $url . "?" . http_build_query($params);

        return redirect()->away($redirectUrl);
    }

    public function deposit_return()
    {

        return view('dashboard');
    }

    public function deposit_callback(Request $request)
    {

        $data = $request->all();
        Log::debug($data);

        // $user = User::find($data->client_id)

        return view('dashboard');
    }
}
