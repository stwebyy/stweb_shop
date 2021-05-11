<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;

class ProductController extends Controller
{
    /**
     * 商品詳細ページの表示
     * @param string 商品ID
     *
     * @return view
     */
    public function __invoke($id)
    {
        $tags = Tag::all();
        $product = Product::find($id);
        $product_tags = $product->tags;

        return view('general.product.detail', [
            'product' => $product,
            'tags' => $tags,
            'product_tags' => $product_tags,
        ]);
    }
}
