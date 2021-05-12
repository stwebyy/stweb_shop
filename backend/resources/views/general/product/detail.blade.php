@extends('layouts.product_app')

@section('content')
<div class="row">
    <div class="col-12 mt-5">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title h-50p">商品名：{{ $product->name }}</h5>
                <p class="card-text">
                    カテゴリ：&nbsp;
                    @foreach ($product_tags as $product_tag)
                        <a href="{{ route('index') . "?search_tag=$product_tag->id" }}">{{ $product_tag->name }}</a>
                    @endforeach
                </p>
                <p class="card-text">価格：&nbsp;¥{{ number_format($product->price) }}</p>
                <p class="card-text">商品概要：{{ $product->description }}</p>
                @if (Auth::check())
                <form action="#" method="POST">
                    <p class="card-text">
                        <label>数量：</label>
                        <select name="cart_quantity">
                            @php
                                $max_count = $product->stock > 100 ? 100 : $product->stock;
                            @endphp
                            @for ($i = 1; $i < $max_count; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </p>
                    <input type="submit" class="btn btn-dark mt-2" value="カートに入れる">
                </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-12 text-center mt-5">
        <a class="btn btn-dark" href="{{ route('index') }}">TOP/商品一覧へ</a>
    </div>     
</div>
@endsection