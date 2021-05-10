<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
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
        $search_query = $request->query('search_tag');
        if ($search_query) {
            $products_collect = Tag::find($search_query)->products;
            $current_page = $request->page ?? 1;
            $products = new LengthAwarePaginator(
                $products_collect->forPage($current_page, 20),
                count($products_collect),
                20,
                $current_page,
            );
        } else {
            $products = Product::Paginate(50);
        }

        return view('index', [
            'products' => $products,
            'tags' => $tags,
            'search_query' => ['search_tag' => $search_query],
        ]);
    }
}
