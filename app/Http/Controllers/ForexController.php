<?php

namespace App\Http\Controllers;

use App\Models\ForexPair;
use App\Models\Order;
use App\Services\RunningNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForexController extends Controller
{
    //

    public function forexPair()
    {

        $allPairs = ForexPair::where('status', 'active')->get();

        return view('Exchange/Exchange', [
            'allPairs' => $allPairs
        ]);
    }

    public function openOrders(Request $request)
    {
        $user = Auth::user();

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

        return redirect()->back();
    }

    public function closeOrder(Request $request)
    {
        
        $user = Auth::user();

        $order = Order::where('order_id', $request->orderId)->first();
        
        $order->update([
            'close_price' => $request->marketPrice,
            'close_time' => now(),
            'profit' => $request->price,
            'status' => 'closed',
        ]);

        return redirect()->back();
    }
}
