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
     * @return View
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cart_items = $cart->products;

        return view('general.cart.index', [
            'cart_items' => $cart_items
        ]);
    }

    /**
     * カートに商品を追加もしくはカートの更新を行う
     *
     * @param Request
     *
     * @return View
     */
    public function addOrEditCart(Request $request)
    {
        $user_id = Auth::id();
        if (!Cart::where('user_id', $user_id)->first()) {
            Cart::create(['user_id' => $user_id]);
        }

        $product_id = $request->input('product_id');
        $quantity = $request->input('cart_quantity');

        $product = Product::find($product_id);
        $cart = Cart::where('user_id', $user_id)->first();
        $cart_item = $cart->products;
        if ($cart_item->where('id', $product_id)->count()) {
            $cart->products()->updateExistingPivot($product, [
                'quantity' => $quantity,
            ]);
            \Log::info('ユーザーID: ' . $user_id . 'のカートを更新しました。');

            return back()->with('flash_message', 'カートを更新しました。');
        }

        $cart->products()->save($product, [
            'quantity' => $quantity,
        ]);
        \Log::info('ユーザーID: ' . $user_id . 'のカート情報を追加しました。');

        return back()->with('flash_message', 'カートに追加しました。');
    }

    /**
     * カートから指定の商品を削除する
     *
     * @param String Product ID
     *
     * @return View
     */
    public function deleteCartItem($id)
    {
        $user_id = Auth::id();

        $cart = Cart::where('user_id', $user_id)->first();
        $cart->products()->detach($id);

        \Log::info('ユーザーID: ' . $user_id . "のカートからProduct ID: $id を削除しました。");

        return back()->with('flash_message', 'カートの削除を行いました。');
    }
}
