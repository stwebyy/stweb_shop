@extends('layouts.admin_app')

@section('content')
<div class="row">
    <div class="offset-3 col-6">
        <div class="accordion mt-5 text-center" id="accordionExample">
            <div class="card">
                <div class="card-header" id="heading1">
                    <h2 class="mb-0">
                        <button class="btn btn-link fc-bk" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">商品管理</button>
                    </h2>
                </div>
                <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample">
                    <div class="card-body">
                        <a href="{{ route('admin_product_index') }}" class="d-block admin-menu-list mt-3 mb-3 fc-bk">商品一覧</a>
                        <a href="{{ route('admin_product_create') }}" class="d-block admin-menu-list mt-3 mb-3 fc-bk">商品登録</a>
                        <a href="{{ route('admin_tag_index') }}" class="d-block admin-menu-list mt-3 mb-3 fc-bk">タグ管理</a>
                    </div>
                </div>
            </div>
        
            <div class="card">
                <div class="card-header" id="heading2">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed fc-bk" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">受注管理</button>
                    </h2>
                </div>
        
                <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
                    <div class="card-body">
                        <a href="{{ route('admin_order_index') }}" class="d-block admin-menu-list mt-3 fc-bk">受注一覧</a>
                        <a href="#" class="d-block admin-menu-list mt-3 fc-bk">受注管理</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection