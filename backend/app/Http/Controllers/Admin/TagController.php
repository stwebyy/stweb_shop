<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * 管理タグ一覧画面の表示
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
        } elseif($sort_query === 'oldest_created') {
            $tags = Tag::orderBy('created_at')->paginate(100);
        } elseif($sort_query === 'latest_updated') {
            $tags = Tag::orderBy('updated_at', 'DESC')->paginate(100);
        } elseif($sort_query === 'oldest_updated') {
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
}
