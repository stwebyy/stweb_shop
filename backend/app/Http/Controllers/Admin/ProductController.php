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
     * @param Request
     *
     * @return view
     */
    public function index(Request $request)
    {
        $sort_query = $request->query('sort_query');
        if ($sort_query === 'latest_created') {
            $products = Product::orderBy('created_at', 'DESC')->paginate(100);
        } elseif($sort_query === 'oldest_updated') {
            $products = Product::orderBy('update_at')->paginate(100);
        } elseif($sort_query === 'latest_updated') {
            $products = Product::orderBy('update_at', 'DESC')->paginate(100);
        } elseif($sort_query === 'oldest_updated') {
            $products = Product::orderBy('update_at')->paginate(100);
        } elseif ($sort_query === 'cheap') {
            $products = Product::orderBy('price')->paginate(100);
        } elseif ($sort_query === 'expensive') {
            $products = Product::orderBy('price', 'DESC')->paginate(100);
        } elseif ($sort_query === 'few') {
            $products = Product::orderBy('stock')->paginate(100);
        } elseif ($sort_query === 'many') {
            $products = Product::orderBy('stock', 'DESC')->paginate(100);
        } elseif ($sort_query === 'mine') {
            $products = Product::where('admin_user_id', \Auth::id())->paginate(100);
        } else {
            $products = Product::paginate(100);
        }

        return view('admin.product.index', [
            'products' => $products,
            'sort_query' => ['sort_query' => $sort_query],
        ]);
    }

    /**
     * 商品登録ページの表示
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.product.create', [
            'tags' => $tags,
        ]);
    }

    /**
     * 商品登録処理
     * @param Request
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
        $new_product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $request->input('image'),
            'admin_user_id' => \Auth::id(),
        ]);

        if ($request->input('tag')) {
            foreach ($request->input('tag') as $target_tag) {
                $new_product->tags()->attach($target_tag);
            }
        }

        return redirect(route('admin_product_index'))->with('flash_message', '商品を登録しました。');
    }

    /**
     * 商品詳細ページの表示
     * @param Strign $id
     *
     * @return View
     */
    public function detail($id)
    {
        $product = Product::find($id);
        $tags = Tag::all();

        return view('admin.product.detail', [
            'product' => $product,
            'tags' => $tags,
        ]);
    }

    /**
     * 商品の更新
     * 
     * @param Request
     * @param String Product_ID
     * 
     * @return Redirect
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $this->authorize('update', $product);

        $product_columns = [
            $request->input('name'),
            $request->input('description'),
            $request->input('price'),
            $request->input('stock'),
        ];

        $product->fill($product_columns)->save();

        // requestの中に登録されているタグ情報がない場合は既存のタグ情報を削除
        foreach ($product->tags as $old_tag) {
            if (!in_array($old_tag, $request->input('tag'))) {
                $product->tags()->detach($old_tag->id);
            };
        }

        foreach ($request->input('tag') as $target_tag) {
            if (!$product->tags->contains('id', $target_tag)) {
                $product->tags()->attach($target_tag);
            }
        }

        return redirect(route('admin_product_detail', $product->id))->with('flash_message', '商品を更新しました。');
    }

    /**
     * 商品の削除
     * @param String Product_ID
     * 
     * @return Redirect
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $this->authorize('delete', $product);

        $product->delete();

        return redirect(route('admin_product_index'))->with('flash_message', '商品を削除しました。');
    }

}
