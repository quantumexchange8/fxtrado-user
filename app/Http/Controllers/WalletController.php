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

use function PHPUnit\Framework\isEmpty;

class WalletController extends Controller
{
    public function wallet()
    {

        $user = Auth::user()->id;

        $transactions = Transaction::where('user_id', $user)->latest()->get();

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
        // $token = Str::random(40);
        
        $checkTransaction = Transaction::where('user_id', $user->id)->where('status', 'processing')->first();

        $payoutSetting = config('payment-gateway');
        $domain = $_SERVER['HTTP_HOST'];

        if ($domain === 'user.fxtrado.com') {
            $selectedPayout = $payoutSetting['live'];
        } else {
            $selectedPayout = $payoutSetting['staging'];
        }

        if ($checkTransaction) {

            $vCode = md5($selectedPayout['appId'] . $checkTransaction->transaction_number . $selectedPayout['merchantId'] . $selectedPayout['ttKey']);

            $params = [
                'orderNumber' => $checkTransaction->transaction_number,
                'userId' => $user->id,
                'merchantId' => $selectedPayout['merchantId'],
                'vCode' => $vCode,
                // 'token' => $token,
                'userName' => $user->name,
                'userEmail' => $user->email,
                'locale' => app()->getLocale(),
            ];
        } else {
            $transaction_id = RunningNumberService::getID('transaction');
            $vCode = md5($selectedPayout['appId'] . $transaction_id . $selectedPayout['merchantId'] . $selectedPayout['ttKey']);

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'transaction_number' => $transaction_id,
                'transaction_type' => 'Deposit',
                'status' => 'processing',
            ]);

            $params = [
                'orderNumber' => $transaction_id,
                'userId' => $user->id,
                'merchantId' => $selectedPayout['merchantId'],
                'vCode' => $vCode,
                // 'token' => $token,
                'userName' => $user->name,
                'userEmail' => $user->email,
                'locale' => app()->getLocale(),
            ];
        }

        $url = $selectedPayout['paymentUrl'] . '/payment';
        $redirectUrl = $url . "?" . http_build_query($params);

        return redirect()->away($redirectUrl);
    }

    public function deposit_return(Request $request)
    {
        $data = $request->all();
        // Log::debug('data from return', $data);

        return to_route('forex_pair');
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
        $wallet = Wallet::where('user_id', $transaction->user_id)->first();

        $payoutSetting = config('payment-gateway');
        $domain = $_SERVER['HTTP_HOST'];

        if ($domain === 'user.fxtrado.com') {
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

            $wallet->balance += $result['amount'];
            $wallet->save();

            return response()->json(['success' => true, 'message' => 'Deposit Success']);
        }

        return response()->json(['success' => false, 'message' => 'Deposit Failed']);
    }

    public function withdrawal(Request $request)
    {

        $user = Auth::user();
        $wallet = Wallet::where('user_id', $user->id)->first();
        
        if ($request->wallet_address == null) {
            return response()->json(['error' => 'Failed, Wallet address field is required'], 400);
        }

        if ($request->amount > $wallet->balance) {
            return response()->json(['error' => 'Failed, withdraw amout exceed wallet balance'], 400);
        }

        if ($request->amount <= 0 ) {
            return response()->json(['error' => 'Failed, invalid withdraw amout'], 400);
        }

        $wallet->balance -= $request->amount;
        $wallet->save();
        
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'to_wallet' => $request->wallet_address,
            'amount' => $request->amount,
            'transaction_type' => 'Withdrawal',
            'status' => 'processing',
        ]);

        return response()->json(['message' => 'Withdrawal successful']);
    }

    public function depositTransaction(Request $request)
    {

        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'transaction_type' => 'Deposit',
            'amount' => $request->amount,
            'status' => 'system_deposit',
        ]);

        return redirect()->back();
    }
}
