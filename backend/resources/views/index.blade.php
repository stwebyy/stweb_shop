@extends('layouts.product_app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-6">
      @if ($target_tag)
      <p><strong>絞り込みカテゴリ： {{ $target_tag->name }}</strong></p>
      @endif
      @if (request()->sort_query)
      <p>
        @if (request()->sort_query === "latest")
          <strong>ソート順： 新着順</strong>
        @elseif (request()->sort_query === "cheap")           
          <strong>ソート順： 価格の安い順</strong>
        @elseif (request()->sort_query === "expensive")           
          <strong>ソート順： 価格の高い順</strong>
        @elseif (request()->sort_query === "many")           
          <strong>ソート順： 在庫の多い順</strong>
        @elseif (request()->sort_query === "few")           
          <strong>ソート順： 在庫の少ない順</strong>
        @endif
      </p>
      @endif
      </div>
      <form id="sort_form" class="{{ $target_tag ? 'offset-2' : 'offset-8'}} col-3 text-right" action="{{ route('index') }}" method="GET">
        @if ($target_tag)
          <input type="hidden" name="search_tag" value="{{ $target_tag->id }}">
        @endif
        <select id="sort" class="form-control" name="sort_query">
          <option value="">-</option>
          <option value="latest">新着順</option>
          <option value="cheap">価格の安い順</option>
          <option value="expensive">価格の高い順</option>
          <option value="many">在庫の多い順</option>
          <option value="few">在庫の少ない順</option>
        </select>
      </form>
    </div>
  </div>
  @foreach ($products as $product)
    <div class="col-sm-3 mt-5">
        <div class="card text-center">
          <div class="card-body">
            <a href="{{ route('product_detail', $product->id) }}"><h5 class="card-title h-50p">{{ $product->name }}</h5></a>
            <p class="card-text">価格&nbsp;¥{{ number_format($product->price) }}</p>
              @if (Auth::check())
              <form action="#" method="POST">
                <p>
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

@section('script')
@parent
    <script>
      $(document).on('change', '#sort', function() {
        $('#sort_form').submit();
      })
    </script>
@endsection