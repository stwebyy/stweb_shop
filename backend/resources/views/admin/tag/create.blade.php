@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">タグ登録ページ</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_tag_store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label text-md-right">タグ名</label>
                            <input id="name" type="text" class="form-control" name="name" value="" required placeholder="タグ名" autocomplete="name">
                        </div>
                        <div class="form-group row mb-0 text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6 text-center mt-5">
            <a class="btn btn-dark" href="{{ route('admin_tag_index') }}">タグ一覧へ</a>
        </div>
    </div>
</div>
@endsection
