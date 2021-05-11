@extends('layouts.product_app')

@section('content')
<div class="row">
  @if ($target_tag)
  <p class="col-12"><strong>絞り込みカテゴリ： {{ $target_tag->name }}</strong></p>
  @endif
  @foreach ($products as $product)
    <div class="col-sm-3 mt-5">
        <div class="card text-center">
          <div class="card-body">
            <a href="{{ route('product_detail', $product->id) }}"><h5 class="card-title h-50p">{{ $product->name }}</h5></a>
            <p class="card-text">価格&nbsp;¥{{ number_format($product->price) }}</p>
            <a href="#" class="btn btn-dark mt-2">カートに入れる</a>
          </div>
        </div>
      </div>        
    @endforeach
</div>
<div class="d-flex justify-content-center mt-4">
    @if ($search_tag)
    {{ $products->appends($search_tag)->links() }}
    @else
    {{ $products->links() }}
    @endif
</div>
@endsection