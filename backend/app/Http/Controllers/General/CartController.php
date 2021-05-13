<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * カート画面の表示
     * 
     * @return view
     */
    public function index()
    {
        $cart_info = Auth::user()->cart;

        return view('general.cart', [
            'cart_info' => $cart_info
        ]);
    }

    /**
     * カートに商品を追加する
     * 
     * @param Request
     * 
     * @return View
     */
    public function addCart(Request $request)
    {
        $user = Auth::user();
        if (!$user->cart) {
            Cart::create(['user_id' => $user->id]);
        }

        $product_id = $request->input('product_id');
        $quantity = $request->input('cart_quantity');
        $product = Product::find($product_id);
        $cart = Cart::where('user_id', $user->id)->first();
        $cart_item = $cart->products;
        if ($cart_item->where('id', $product_id)->count()) {
            $quantity += $cart_item->firstWhere('id', $product_id)->pivot->quantity;
        }

        $cart->products()->save($product, [
            'quantity' => $quantity,
        ]);
        \Log::info('ユーザーID: ' . $user->id . 'のカート情報を追加しました。');

        return back()->with('flash_message', 'カートに追加しました。');
    }
}
