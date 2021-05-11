@extends('layouts.product_app')

@section('content')
<div class="row">
    <div class="col-12 mt-5">
        <div class="card text-center">
            <div class="card-body">
                <form action="#" method="POST">
                    <h5 class="card-title h-50p">商品名：{{ $product->name }}</h5>
                    <p class="card-text">
                        カテゴリ：&nbsp;
                        @foreach ($product_tags as $product_tag)
                            <a href="{{ route('index') . "?search_tag=$product_tag->id" }}">{{ $product_tag->name }}</a>
                        @endforeach
                    </p>
                    <p class="card-text">価格：&nbsp;¥{{ number_format($product->price) }}</p>
                    <p class="card-text">商品概要：{{ $product->description }}</p>
                    <p class="card-text">
                        <label>数量：</label>
                        <select name="cart_quantity">
                            @for ($i = 1; $i < $product->stock; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </p>
                    <input type="submit" class="btn btn-dark mt-2" value="カートに入れる">
                </form>
            </div>
        </div>
      </div>        
</div>
@endsection