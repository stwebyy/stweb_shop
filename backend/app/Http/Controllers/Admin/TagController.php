<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * タグ一覧画面の表示
     *
     * @param Request
     *
     * @return View
     */
    public function index(Request $request)
    {
        $sort_query = $request->query('sort_query');

        if ($sort_query === 'latest_created') {
            $tags = Tag::orderBy('created_at', 'DESC')->paginate(100);
        } elseif ($sort_query === 'oldest_created') {
            $tags = Tag::orderBy('created_at')->paginate(100);
        } elseif ($sort_query === 'latest_updated') {
            $tags = Tag::orderBy('updated_at', 'DESC')->paginate(100);
        } elseif ($sort_query === 'oldest_updated') {
            $tags = Tag::orderBy('updated_at')->paginate(100);
        } elseif ($sort_query === 'few') {
            $tags = Tag::withCount('products')->orderBy('products_count')->paginate(100);
        } elseif ($sort_query === 'many') {
            $tags = Tag::withCount('products')->orderBy('products_count', 'DESC')->paginate(100);
        } else {
            $tags = Tag::paginate(100);
        }

        return view('admin.tag.index', [
            'tags' => $tags,
        ]);
    }

    /**
     * タグ登録ページの表示
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * タグ登録処理
     * @param Request
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
        Tag::create([
            'name' => $request->input('name'),
        ]);

        return redirect(route('admin_tag_index'))->with('flash_message', 'タグを登録しました。');
    }


    /**
     * タグ詳細ページの表示
     * @param Strign $id
     *
     * @return View
     */
    public function detail($id)
    {
        $tag = Tag::find($id);
        $products = Tag::find($id)->products()->paginate(40);

        return view('admin.tag.detail', [
            'products' => $products,
            'tag' => $tag,
        ]);
    }

    /**
     * 商品の更新
     *
     * @param Request
     * @param String Tag_ID
     *
     * @return Redirect
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $request->input('name');
        $tag->save();

        return redirect(route('admin_tag_detail', $tag->id))->with('flash_message', 'タグを更新しました。');
    }

    /**
     * 商品の削除
     * @param String Tag_ID
     *
     * @return Redirect
     */
    public function delete($id)
    {
        $tag = Tag::find($id);

        $tag->delete();

        return redirect(route('admin_tag_index'))->with('flash_message', '商品を削除しました。');
    }
}
