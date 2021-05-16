@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">商品詳細ページ</div>
                @cannot('update', $product)
                <div class="offset-2 col-8 alert alert-warning mt-5 text-center" role="alert">
                    この商品の登録者のみ商品情報の編集ができます。
                </div>
                @endcannot
                @if (session('flash_message'))
                <div class="offset-2 col-8 alert alert-primary mt-5" role="alert">
                    {{ session('flash_message') }}
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_product_detail_update', $product->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">商品名</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" required placeholder="商品名" autocomplete="name" @cannot('update', $product) disabled @endcannot>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label text-md-right">説明</label>
                            <input id="description" type="text" class="form-control" name="description" value="{{ $product->description }}" required placeholder="説明" autocomplete="description" @cannot('update', $product) disabled @endcannot>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-form-label text-md-right">価格</label>
                            <input id="price" type="text" class="form-control" name="price" value="{{ $product->price }}" required placeholder="価格" autocomplete="price" @cannot('update', $product) disabled @endcannot>
                        </div>
                        <div class="form-group">
                            <label for="stock" class="col-form-label text-md-right">在庫数</label>
                            <input id="stock" type="text" class="form-control" name="stock" value="{{ $product->stock }}" required placeholder="在庫数" autocomplete="stock" @cannot('update', $product) disabled @endcannot>
                        </div>
                        <div class="form-group">
                            <label for="tag" class="col-form-label text-md-right">関連タグ</label>
                            <select id="tag" class="form-control" name="tag[]" multiple @cannot('update', $product) disabled @endcannot>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" @if ($product->tags->contains('id', $tag->id)) {{ 'selected' }} @endif>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock" class="col-form-label text-md-right">在庫数</label>
                            <input id="stock" type="text" class="form-control" name="stock" value="{{ $product->stock }}" required placeholder="在庫数" autocomplete="name" @cannot('update', $product) disabled @endcannot>
                        </div>
                        <div class="form-group">
                            <label for="stock" class="col-form-label text-md-right">在庫数</label>
                            <input id="stock" type="text" class="form-control" name="stock" value="{{ $product->stock }}" required placeholder="在庫数" autocomplete="name" @cannot('update', $product) disabled @endcannot>
                        </div>

                        @can('update', $product)
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-dark">
                                    更新
                                </button>
                            </div>
                        </div>
                        @endcan
                    </form>
                    @can('update', $product)
                    <form class="mt-4" method="POST" action="{{ route('admin_product_detail_delete', $product->id) }}">
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
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-12 text-center mt-5">
            <a class="btn btn-dark" href="{{ route('admin_product_index') }}">商品一覧へ</a>
        </div>
    </div>
</div>
@endsection
