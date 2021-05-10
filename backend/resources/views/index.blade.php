@extends('layouts.product_app')

@section('content')
<div class="row">
    @foreach ($products as $product)
    {{-- @php
        dd($products->products);
    @endphp --}}
    <div class="col-sm-3 mt-5">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title h-50p">{{ $product->name }}</h5>
            <p class="card-text">価格&nbsp;¥{{ number_format($product->price) }}</p>
            <a href="#" class="btn btn-dark mt-2">カートに入れる</a>
          </div>
        </div>
      </div>        
    @endforeach
</div>
<div class="d-flex justify-content-center mt-4">
    @if ($search_query)
    {{ $products->appends($search_query)->links() }}
    @else
    {{ $products->links() }}
    @endif
</div>
@endsection