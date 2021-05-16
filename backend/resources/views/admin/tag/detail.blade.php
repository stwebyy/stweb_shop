@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">タグ詳細ページ</div>
                @if (session('flash_message'))
                <div class="offset-2 col-8 alert alert-primary mt-5" role="alert">
                    {{ session('flash_message') }}
                </div>                                                  
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_tag_detail', $tag->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">タグ名</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $tag->name }}" required placeholder="商品名" autocomplete="name">
                        </div>
                        <div class="form-group">
                            <div class="col-form-label text-left">関連商品数</div>
                            <div class="border-underline p-1">{{ $tag->products->count() }}</div>
                        </div>
                        <div class="form-group">
                            <div class="col-form-label text-left">登録日</div>
                            <div class="border-underline p-1">{{ $tag->created_at }}</div>
                        </div>
                        <div class="form-group">
                            <div class="col-form-label text-left">更新日</div>
                            <div class="border-underline p-1">{{ $tag->updated_at }}</div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-dark">
                                    更新
                                </button>
                            </div>
                        </div>
                    </form>
                    <form class="mt-4" method="POST" action="{{ route('admin_tag_detail', $tag->id) }}">
                        <input type="hidden" name="_method" value="delete" />
                        @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-danger">
                                    削除
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h4 class="mt-5">関連商品一覧</h4>
            <table class="table table-striped mt-5">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">商品ID</th>
                    <th scope="col">商品名</th>
                    <th scope="col">価格</th>
                    <th scope="col">在庫</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><a href="{{ route('admin_product_detail', $product->id) }}">{{ $product->name }}</a></td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>    
        </div>
        <div class="col-12 text-center mt-5">
            <a class="btn btn-dark" href="{{ route('admin_tag_index') }}">タグ一覧へ</a>
        </div>
    </div>
</div>
@endsection
