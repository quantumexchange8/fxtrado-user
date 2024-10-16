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

        $orders = Order::where('user_id', $user->id)->where('status', 'closed')->get();

        return view('Orders/Orders', [
            'orders' => $orders,
        ]);
    }
}
