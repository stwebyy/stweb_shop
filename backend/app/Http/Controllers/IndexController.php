<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexController extends Controller
{
    /**
     * TOPページの表示
     * @param Request
     *
     * @return view
     */
    public function __invoke(Request $request)
    {
        $tags = Tag::all();
        $search_tag = $request->query('search_tag');
        if ($search_tag) {
            $products_collect = Tag::find($search_tag)->products;
            $current_page = $request->page ?? 1;
            $products = new LengthAwarePaginator(
                $products_collect->forPage($current_page, 20),
                count($products_collect),
                20,
                $current_page,
            );
            $target_tag = Tag::find($request->query('search_tag')); 
        } else {
            $products = Product::Paginate(20);
            $target_tag = null;
        }

        return view('index', [
            'products' => $products,
            'tags' => $tags,
            'search_tag' => ['search_tag' => $search_tag],
            'target_tag' => $target_tag,
        ]);
    }
}