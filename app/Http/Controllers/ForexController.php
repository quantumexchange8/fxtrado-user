<?php

namespace App\Http\Controllers;

use App\Models\ForexPair;
use App\Models\HistoryChart;
use App\Models\Order;
use App\Models\Wallet;
use App\Services\RunningNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ForexController extends Controller
{
    //

    public function forexPair()
    {
        $user = Auth::user();
        $allPairs = ForexPair::where('status', 'active')->get();
        $orderHistories = Order::where('user_id', $user->id)
            ->where('status', 'closed')
            ->latest()
            ->take(5)
            ->get();

        return view('Exchange/Exchange', [
            'allPairs' => $allPairs,
            'orderHistories' => $orderHistories,
        ]);
    }

    public function openOrders(Request $request)
    {
        $user = Auth::user();

        $wallet = Wallet::where('user_id', $user->id)->first();

        if ($request->price <= 0) {
            return response()->json(['success' => false, 'message' => 'Invalid Open Pricing']);
        }
        
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

        if ($order->status === 'closed') {
            return redirect()->route('orders');
        }

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
            $profit = ($order->close_price - $order->price) * $order->volume * $decimal;
            $closeprice = $order->close_price;

        } elseif ($order->type === 'sell') {
            $profit = ($order->price - $order->close_price ) * $order->volume * $decimal;
            $closeprice = $order->close_price;
        }

        $wallet->balance += $profit;
        $wallet->save();

        $order->closed_profit = $profit;
        $order->close_price = $closeprice;
        $order->save();

        Log::debug(['calculation details', $order->order_id, $profit]);

        return redirect()->route('orders');
    }

    public function getChartData(Request $request)
    {
        $symbol = $request->query('symbol');
        
        // Fetch candlestick data (you'll need to adjust your query to fit your DB structure)
        $candles = DB::table('history_chart')
                    ->where('symbol', $symbol)
                    ->select('Date', 'open', 'high', 'low', 'close', 'volume')
                    ->orderBy('Date', 'asc')
                    ->get();

        // Return data in JSON format
        return response()->json($candles);
    }

    public function getCandles(Request $request)
    {
        
        $symbol = $request->symbol;
        
        $candle = HistoryChart::where('Symbol', $symbol)->get();
        
        return response()->json($candle);
    }
}
