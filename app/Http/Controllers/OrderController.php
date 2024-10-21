<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders()
    {

        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->where('status', 'closed')->latest()->get();
        $openOrders = Order::where('user_id', $user->id)->where('status', 'open')->get();

        return view('Orders/Orders', [
            'orders' => $orders,
            'openOrders' => $openOrders,
        ]);
    }
}
