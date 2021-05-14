@extends('layouts.app')

@section('content')
<div class="row">
    <div class="offset-2 col-8 mt-5">
        @if (session('flash_message'))
        <div class="offset-2 col-8 alert alert-primary" role="alert">
            {{ session('flash_message') }}
        </div>                                                  
        @endif
        <div class="card text-center">
            <div class="card-header text-left fs-20">
                <strong>カート</strong>
              </div>
              <ul class="list-group list-group-flush">
                  @foreach ($cart_items as $cart_item)
                  <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="w-80 text-left">
                                <p class="cart-list-item">商品名：&nbsp;<a href="{{ route('product_detail', $cart_item->id) }}">{{ $cart_item->name }}</a></p>
                                <form id="cart-quantity" class="cart-list-item" action="{{ route('cart_add_edit') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $cart_item->id }}">
                                    <span class="d-inline-block cart-item-price">価格：{{ $cart_item->price }}</span>
                                    <span class="d-inline-block">個数：
                                        <select id="item-quantity" class="form-control cart-item-quantity" name="cart_quantity">
                                            @php
                                            $max_count = $cart_item->stock > 100 ? 100 : $cart_item->stock;
                                            @endphp
                                            @for ($i = 1; $i < $max_count; $i++)
                                                <option value="{{ $i }}" {{ ($cart_item->pivot->quantity === $i) ? 'selected' : null }}>{{ $i }}</option>
                                            @endfor        
                                        </select>
                                    </span>
                                </form>
                            </div>
                            <form action="{{ route('cart_item_delete', $cart_item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark" name="remove_item">削除</button>
                            </form>
                        </div>
                    </form>
                </li>
                  @endforeach
              </ul>
        </div>
    </div>
    <div class="col-12 text-center mt-5">
        <form action="{{ route('order_create') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">ご注文</button>
        </form>
    </div>     
    <div class="col-12 text-center mt-5">
        <a class="btn btn-dark" href="{{ route('index') }}">TOP/商品一覧へ</a>
    </div>     
</div>
@endsection

@section('script')
@parent
    <script>
      $(document).on('change', '#item-quantity', function() {
        $(this).parent().parent().submit();
      })
    </script>
@endsection
