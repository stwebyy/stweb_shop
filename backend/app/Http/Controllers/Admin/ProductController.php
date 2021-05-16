<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;

class ProductController extends Controller
{
    /**
     * 商品一覧ページの表示
     *
     * @return view
     */
    public function index(Request $request)
    {
        $sort_query = $request->query('sort_query');
        if ($sort_query === 'latest_created') {
            $products = Product::orderBy('created_at', 'DESC')->paginate(100);
        } elseif($sort_query === 'latest_updated') {
            $products = Product::orderBy('update_at', 'DESC')->paginate(100);
        } elseif ($sort_query === 'cheap') {
            $products = Product::orderBy('price')->paginate(100);
        } elseif ($sort_query === 'expensive') {
            $products = Product::orderBy('price', 'DESC')->paginate(100);
        } elseif ($sort_query === 'few') {
            $products = Product::orderBy('stock')->paginate(100);
        } elseif ($sort_query === 'many') {
            $products = Product::orderBy('stock', 'DESC')->paginate(100);
        } else {
            $products = Product::paginate(100);
        }

        return view('admin.product.index', [
            'products' => $products,
            'sort_query' => ['sort_query' => $sort_query],
        ]);
    }
}
