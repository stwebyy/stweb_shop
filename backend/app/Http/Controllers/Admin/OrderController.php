<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * 受注一覧画面の表示
     *
     * @param Request
     *
     * @return View
     */
    public function index(Request $request)
    {
        $sort_query = $request->query('sort_query');
        if ($sort_query === 'latest_created') {
            $orders = Order::orderBy('created_at', 'DESC')->paginate(100);
        } elseif ($sort_query === 'oldest_updated') {
            $orders = Order::orderBy('created_at')->paginate(100);
        } elseif ($sort_query === 'latest_updated') {
            $orders = Order::orderBy('updated_at', 'DESC')->paginate(100);
        } elseif ($sort_query === 'oldest_updated') {
            $orders = Order::orderBy('updated_at')->paginate(100);
        } else {
            $orders = Order::paginate(100);
        }

        return view('admin.order.index', [
            'orders' => $orders,
            'sort_query' => $sort_query,
        ]);
    }

    /**
     * 受注詳細の表示
     *
     * @param Request
     * @param String Order_ID
     *
     * @return View
     */
    public function detail($id)
    {
        $order = Order::find($id);
        $products = $order->orderItems;

        return view('admin.order.detail', [
            'order' => $order,
            'products' => $products,
        ]);
    }
}
