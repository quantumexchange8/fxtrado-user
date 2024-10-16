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

        $user = Auth::user()->id;

        $transactions = Transaction::where('user_id', $user)->get();

        return view('Wallets/Wallet', [
            'transactions' => $transactions
        ]);
    }

    public function walletTransaction()
    {

        return view('Wallets/Transaction');
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

        if ($domain === 'fxtrado-user.com') {
            $selectedPayout = $payoutSetting['live'];
        } else {
            $selectedPayout = $payoutSetting['staging'];
        }

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

    public function deposit_return(Request $request)
    {
        $data = $request->all();
        Log::debug('data from return', $data);

        if ($data['response_status'] == 'success') {

            $result = [
                "amount" => $data['transfer_amount'],
                "transaction_number" => $data['transaction_number'],
                "txid" => $data['txID'],
            ];

            $transaction = Transaction::query()
                ->where('transaction_number', $result['transaction_number'])
                ->first();

            $result['date'] = $transaction->approved_at;

            return redirect()->route('dashboard')->with('notification', [
                'details' => $transaction,
                'type' => 'deposit',
            ]);
        } else {
            return to_route('dashboard');
        }
    }

    public function depositCallback(Request $request)
    {

        $data = $request->all();
        Log::debug('data from callback', $data);

        $result = [
            "token" => $data['vCode'],
            "from_wallet" => $data['from_wallet'],
            "to_wallet" => $data['to_wallet'],
            "txid" => $data['txID'],
            "transaction_number" => $data['transaction_number'],
            "amount" => $data['transfer_amount'],
            "status" => $data["status"],
            "remarks" => 'System Approval',
        ];

        $user = Auth::user();
        $transaction = Transaction::where('transaction_number', $result['transaction_number'])->first();

        $payoutSetting = config('payment-gateway');
        $domain = $_SERVER['HTTP_HOST'];

        if ($domain === 'fxtrado-user.com') {
            $selectedPayout = $payoutSetting['live'];
        } else {
            $selectedPayout = $payoutSetting['staging'];
        }

        $dataToHash = md5($transaction->transaction_number . $selectedPayout['appId'] . $selectedPayout['merchantId']);
        $status = $result['status'] == 'success' ? 'successful' : 'failed';

        if ($result['token'] === $dataToHash) {
            $transaction->update([
                'from_wallet' => $result['from_wallet'],
                'to_wallet' => $result['to_wallet'],
                'txid' => $result['txid'],
                'amount' => $result['amount'],
                'status' => $status,
                'remarks' => $result['remarks'],
                'approved_at' => now()
            ]);

            if ($transaction->status == 'successful') {
                if ($transaction->transaction_type === 'Deposit') {
                    return response()->json(['success' => true, 'message' => 'Deposit Success']);
                }
            }
        }

        return response()->json(['success' => false, 'message' => 'Deposit Failed']);
    }
}
