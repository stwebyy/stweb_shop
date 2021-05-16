@extends('layouts.admin_app')

@section('content')
<div class="row">
    <div class="offset-2 col-8">
        <h1>受注一覧</h1>
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
        @endif
        </p>
        @endif
        <form id="sort_form" class="offset-8 col-4 text-right mb-3 p-0" action="{{ route('admin_order_index') }}" method="GET">
            <select id="sort" class="form-control" name="sort_query">
              <option value="">-</option>
              <option value="latest_created">新しく登録された順</option>
              <option value="oldest_created">過去に登録された順</option>
              <option value="latest_updated">新しく更新された順</option>
              <option value="oldest_updated">過去に更新された順</option>
            </select>
        </form>    
        <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">受注番号</th>
                <th scope="col">価格</th>
                <th scope="col">受注ステータス</th>
                <th scope="col">受注日</th>
                <th scope="col">更新日</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td><a href="{{ route('admin_order_detail', $order->id) }}">{{ $order->order_number }}</a></td>
                    @php
                    $price = 0;
                    foreach ($order->orderItems as $order_item) {
                        $price += $order_item->price * $order_item->pivot->quantity;
                    }
                    @endphp
                    <td>¥&nbsp;{{ number_format($price) }}</td>
                    <td>{{ $order->status->status }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center mt-4">
            @if ($sort_query)
            {{ $orders->appends($sort_query)->links() }}
            @else
            {{ $orders->links() }}
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
