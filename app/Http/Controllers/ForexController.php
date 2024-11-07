<?php

namespace App\Http\Controllers;

use App\Models\ForexPair;
use App\Models\GroupSymbol;
use App\Models\HistoryChart;
use App\Models\Order;
use App\Models\Wallet;
use App\Services\RunningNumberService;
use Carbon\Carbon;
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

    public function getGroupSymbols()
    {
        $user = Auth::user();
        $groupSymbols = GroupSymbol::where('group_name', $user->group)->where('status', 'active')->get();

        return response()->json($groupSymbols);
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
                'group_name' => $user->group,
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

        if ($order->type === 'buy') {
            $order->update([
                'close_price' => $order->market_bid,
                'close_time' => now(),
                'status' => 'closed',
            ]);
        } else {
            $order->update([
                'close_price' => $order->market_ask,
                'close_time' => now(),
                'status' => 'closed',
            ]);
        }

        $symbol = ForexPair::where('symbol_pair', $order->symbol)->first();
        if ($symbol->digits === 5) {
            $decimal = 100000;
        } elseif ($symbol->digits === 3) {
            $decimal = 1000;
        } elseif ($symbol->digits === 2) {
            $decimal = 100;
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

        // dd($order->close_price, $order->price, $order->volume, $decimal, $closeprice);

        $wallet->balance += $profit;
        $wallet->save();

        $order->closed_profit = $profit;
        $order->close_price = $closeprice;
        $order->save();

        Log::debug(['calculation details', $order->order_id, $profit]);

        return redirect()->route('orders');
    }

    // NOT IN USE
    public function getChartData(Request $request)
    {
        $symbol = $request->query('symbol');
        
        // Fetch candlestick data (you'll need to adjust your query to fit your DB structure)
        $candles = DB::table('history_charts')
                    ->where('symbol', $symbol)
                    ->select('Date', 'open', 'high', 'low', 'close', 'volume')
                    ->orderBy('Date', 'asc')
                    ->get();
        // Return data in JSON format
        return response()->json($candles);
    }

    public function getCandles(Request $request)
    {
        $user = Auth::user();

        $symbol = $request->symbol;
        $currentDate = Carbon::now('UTC');


        
        $startOfPeriod = $currentDate->copy()->subDays($currentDate->dayOfWeek)->setTime(17, 0, 0);
        $endOfPeriod = $startOfPeriod->copy()->addDays(5);

        $day = $currentDate->day;
        $month = $currentDate->month;
        $year = $currentDate->year;

        

        if ($currentDate->between($startOfPeriod, $endOfPeriod)) {
            // current date data
            $candle = HistoryChart::where('Symbol', $symbol)
                    ->where('group', $user->group)
                    ->whereDay('Date', $day)     // Filters records for the current day
                    ->whereMonth('Date', $month) // Filters for the current month
                    ->whereYear('Date', $year)   // Filters for the current year
                    ->get();
                    
        } else {
            // last 5 day open market data
            $candle = HistoryChart::where('Symbol', $symbol)
                    ->whereBetween('Date', [$startOfPeriod, $endOfPeriod])
                    ->get();
        }

        return response()->json($candle);
    }

    public function getRealTimeOHLC(Request $request)
    {
        $symbol = $request->symbol;

        $latestTick = DB::table('ticks')
            ->where('symbol', $symbol)
            ->orderBy('Date', 'desc')
            ->first(['Bid', 'Ask', 'Date']);

        if (!$latestTick) {
            return response()->json(['error' => 'Symbol not found or no data available'], 404);
        }

        $response = [
            'bid' => $latestTick->Bid,
            'ask' => $latestTick->Ask,
            'time' => strtotime($latestTick->Date), // Convert to UNIX timestamp
        ];

        return response()->json($response);
    }
}
