@extends('layouts.admin_app')

@section('content')
<div class="row">
    <div class="offset-2 col-8">
        <h1>タグ一覧</h1>
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
            @elseif (request()->sort_query === "many")
                <strong>ソート順： 関連商品の多い順</strong>
            @elseif (request()->sort_query === "few")
                <strong>ソート順： 関連商品の少ない順</strong>
            @endif
        </p>
        @endif
        <div class="text-right mb-3">
            <a href="{{ route('admin_tag_create') }}">
                <div class="btn btn-product-register">
                    <i class="fas fa-tag"></i>&nbsp;&nbsp;タグ登録
                </div>
            </a>
        </div>
        <form id="sort_form" class="offset-8 col-4 text-right mb-3 p-0" action="{{ route('admin_tag_index') }}" method="GET">
            <select id="sort" class="form-control" name="sort_query">
              <option value="">-</option>
              <option value="latest_created">新しく登録された順</option>
              <option value="oldest_created">過去に登録された順</option>
              <option value="latest_updated">新しく更新された順</option>
              <option value="oldest_updated">過去に更新された順</option>
              <option value="many">関連商品の多い順</option>
              <option value="few">関連商品の少ない順</option>
            </select>
        </form>    
        <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">タグID</th>
                <th scope="col">タグ名</th>
                <th scope="col">関連商品数</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td><a href="{{ route('admin_tag_detail', $tag->id) }}">{{ $tag->name }}</a></td>
                    <td>{{ $tag->products->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $tags->links() }}
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
