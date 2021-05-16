@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">商品登録ページ</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_product_store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">商品名</label>
                            <input id="name" type="text" class="form-control" name="name" value="" required placeholder="商品名" autocomplete="name">
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label text-md-right">説明</label>
                            <input id="description" type="text" class="form-control" name="description" value="" required placeholder="説明" autocomplete="description">
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-form-label text-md-right">価格</label>
                            <input id="price" type="number" class="form-control" name="price" value="" required placeholder="価格" autocomplete="price">
                        </div>
                        <div class="form-group">
                            <label for="stock" class="col-form-label text-md-right">在庫数</label>
                            <input id="stock" type="number" class="form-control" name="stock" value="" required placeholder="在庫数" autocomplete="stock">
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-form-label text-md-right">画像</label>
                            <input id="image" type="file" class="form-control-file" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="tag" class="col-form-label text-md-right">関連タグ</label>
                            <select id="tag" class="form-control" name="tag[]" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row mb-0 text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6 text-center mt-5">
            <a class="btn btn-dark" href="{{ route('admin_product_index') }}">商品一覧へ</a>
        </div>
    </div>
</div>
@endsection
