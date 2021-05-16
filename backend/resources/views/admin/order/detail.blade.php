@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">受注詳細ページ</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="col-form-label text-left">受注番号</div>
                        <div class="border-underline p-1">{{ $order->order_number }}</div>
                    </div>
                    <div class="form-group">
                        <div class="col-form-label text-left">価格</div>
                        @php
                        $price = 0;
                        foreach ($order->orderItems as $order_item) {
                            $price += $order_item->price * $order_item->pivot->quantity;
                        }
                        @endphp    
                        <div class="border-underline p-1">¥&nbsp;{{ number_format($price) }}</div>
                    </div>
                    <div class="form-group">
                        @foreach ($products as $product)
                        <div class="col-form-label text-left">商品内訳:&nbsp;{{ $loop->iteration }}</div>
                        <div class="border-underline p-1">商品名:&nbsp;<a href="{{ route('admin_product_detail', $product->id) }}">{{ $product->name }}</a></div>                            
                        <div class="border-underline p-1">価格:&nbsp;¥&nbsp;{{ number_format($product->price) }}</div>                            
                        <div class="border-underline p-1">個数:&nbsp;{{ $product->pivot->quantity }}</div>                            
                        @endforeach
                    </div>
                    <div class="form-group">
                        <div class="col-form-label text-left">受注ステータス</div>
                        <div class="border-underline p-1">{{ $order->status->status }}</div>
                    </div>
                    <div class="form-group">
                        <div class="col-form-label text-left">受注日</div>
                        <div class="border-underline p-1">{{ $order->created_at }}</div>
                    </div>
                    <div class="form-group">
                        <div class="col-form-label text-left">更新日</div>
                        <div class="border-underline p-1">{{ $order->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 text-center mt-5">
            <a class="btn btn-dark" href="{{ route('admin_order_index') }}">受注一覧へ</a>
        </div>
    </div>
</div>
@endsection
