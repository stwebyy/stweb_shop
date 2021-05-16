<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    private const PRE_ORDER_STATUS = 2;

    public function createOrder()
    {
        $user_id = Auth::id();

        $order = Order::create([
            'user_id' => $user_id,
            'order_status_id' => self::PRE_ORDER_STATUS,
            'order_number' => mt_rand()
        ]);
        \Log::info("userID: $user_id のOrderを作成しました。");
        \Log::info("OrderID: $order->id");
        \Log::info("order_number: $order->order_number");

        $cart = Cart::where('user_id', $user_id)->first();
        $cart_items = $cart->products;

        foreach ($cart_items as $cart_item) {
            $order->orderItems()->save($cart_item, [
                'quantity' => $cart_item->pivot->quantity
            ]);
        }
        \Log::info("order_itemsを作成しました。");

        $cart->delete();
        \Log::info("userID: $user_id のカートを削除しました。");

        return redirect(route('index'))->with(
            'flash_message',
            "ご注文いただきありがとうございます。\n ご注文手続きを完了しました。\n ご注文番号： $order->order_number"
        );
    }
}
