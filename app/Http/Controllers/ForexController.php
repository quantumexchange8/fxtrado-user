<?php

namespace App\Http\Controllers;

use App\Models\ForexPair;
use App\Models\Order;
use App\Models\Wallet;
use App\Services\RunningNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ForexController extends Controller
{
    //

    public function forexPair()
    {
        $user = Auth::user();
        $allPairs = ForexPair::where('status', 'active')->get();
        $orderHistories = Order::where('user_id', $user->id)->where('status', 'closed')->latest()->get();

        return view('Exchange/Exchange', [
            'allPairs' => $allPairs,
            'orderHistories' => $orderHistories,
        ]);
    }

    public function openOrders(Request $request)
    {
        $user = Auth::user();

        $wallet = Wallet::where('user_id', $user->id)->first();
        
        if ($request->price < $wallet->balance) {
            $order = Order::create([
                'user_id' => $user->id,
                'order_id' => RunningNumberService::getID('order_opened'),
                'symbol' => $request->symbol,
                'type' => $request->type,
                'volume' => $request->volume,
                'price' => $request->price,
                'open_time' => now(),
                'status' => 'open',
            ]);

            return response()->json(['success' => true, 'message' => 'Order successfully placed']);
        } else {

            return response()->json(['success' => false, 'message' => 'Insufficient balance']);
        }
    }

    public function closeOrder(Request $request)
    {
        
        $user = Auth::user();

        $order = Order::where('order_id', $request->orderId)->first();
        $wallet = Wallet::where('user_id', $user->id)->first();

        $order->update([
            'close_price' => $request->marketPrice,
            'close_time' => now(),
            'status' => 'closed',
        ]);

        $symbol = ForexPair::where('symbol_pair', $order->symbol)->first();
        if ($symbol->digits === 5) {
            $decimal = 100000;
        } elseif ($symbol->digits === 3) {
            $decimal = 1000;
        } elseif ($symbol->digits === 1) {
            $decimal = 10;
        }

        if ($order->type === 'buy') {
            $profit = ($order->market_bid - $order->price) * $order->volume * $decimal;
            $closeprice = $order->market_bid;
        } elseif ($order->type === 'sell') {
            $profit = ($order->price - $order->market_ask ) * $order->volume * $decimal;
            $closeprice = $order->market_ask;
        }

        $formatProfit = number_format($profit, 2);

        $order->update([
            'profit' => $formatProfit,
            'close_price' => $closeprice,
        ]);
        
        Log::debug([$order->order_id, $formatProfit, $wallet->balance, $wallet->balance += $formatProfit]);
        $wallet->balance += $formatProfit;
        $wallet->save();

        return redirect()->back();
    }
}
