@extends('layouts.admin_app')

@section('content')
<div class="row">
    <div class="offset-2 col-8">
        <h1>商品一覧</h1>
        <hr>
        @if (session('flash_message'))
        <div class="offset-2 col-8 alert alert-primary mt-5" role="alert">
            {{ session('flash_message') }}
        </div>
        @endif
        @if (request()->sort_query)
        <p>
        @if (request()->sort_query === "latest_created")
        <strong>ソート順： 新しく登録された順</strong>
        @elseif (request()->sort_query === "oldest_created")
        <strong>ソート順： 過去に登録された順</strong>
        @elseif (request()->sort_query === "latest_updated")
        <strong>ソート順： 新しく更新された順</strong>
        @elseif (request()->sort_query === "oldest_updated")
        <strong>ソート順： 過去に更新された順</strong>
        @elseif (request()->sort_query === "cheap")
            <strong>ソート順： 価格の安い順</strong>
        @elseif (request()->sort_query === "expensive")
            <strong>ソート順： 価格の高い順</strong>
        @elseif (request()->sort_query === "many")
            <strong>ソート順： 在庫の多い順</strong>
        @elseif (request()->sort_query === "few")
            <strong>ソート順： 在庫の少ない順</strong>
        @elseif (request()->sort_query === "mine")
            <strong>ソート順： 自分が登録した商品</strong>
        @endif
        </p>
        @endif
        <div class="text-right mb-3">
            <a href="{{ route('admin_product_create') }}">
                <div class="btn btn-product-register">
                    <i class="fas fa-archive"></i>&nbsp;&nbsp;商品登録
                </div>
            </a>
        </div>
        <form id="sort_form" class="offset-8 col-4 text-right mb-3 p-0" action="{{ route('admin_product_index') }}" method="GET">
            <select id="sort" class="form-control" name="sort_query">
              <option value="">-</option>
              <option value="latest_created">新しく登録された順</option>
              <option value="oldest_created">過去に登録された順</option>
              <option value="latest_updated">新しく更新された順</option>
              <option value="oldest_updated">過去に更新された順</option>
              <option value="cheap">価格の安い順</option>
              <option value="expensive">価格の高い順</option>
              <option value="many">在庫の多い順</option>
              <option value="few">在庫の少ない順</option>
              <option value="mine">自分が登録した商品</option>
            </select>
        </form>    
        <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">商品ID</th>
                <th scope="col">商品名</th>
                <th scope="col">価格</th>
                <th scope="col">在庫</th>
                <th scope="col">登録日</th>
                <th scope="col">更新日</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><a href="{{ route('admin_product_detail', $product->id) }}">{{ $product->name }}</a></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center mt-4">
            @if ($sort_query)
            {{ $products->appends($sort_query)->links() }}
            @else
            {{ $products->links() }}
            @endif
        </div>    
    
    </div>
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
