<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="ECサイトサンプル" />
        <meta name="format-detection" content="email=no,telephone=no,address=no" />
        <meta property="og:site_name" content="stweb_shop" />
        <meta property="og:locale" content="ja_JP" />
        <!-- Bootstrap CSS -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
            integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/Reboot.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        @section('css')
        @show

        <title>@yield('title')</title>
    </head>
    <body>
        <div id="wrapper">
            @include('commons.header')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center mt-4">TOP/商品一覧</h1>
                        @if (session('flash_message'))
                        <div class="offset-2 col-8 alert alert-primary mt-5" role="alert">
                            カートに追加しました。
                        </div>                                                  
                        @endif
                        <form action="{{ route('index') }}" method="GET">
                            <div class="row mt-5">
                                <div class="offset-2 col-8 form-group">
                                    <input id="search_product" class="form-control" type="text" name="search_product" placeholder="商品検索：検索キーワードを入力">
                                </div>
                                <div class="col-2">
                                    <input type="submit" class="btn btn-dark" value="検索">
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <div>
                                    <form class="text-center fs-14" action="{{ route('index') }}">
                                        <div class="form-group">
                                            <label for="productTag">タグで絞り込み</label>
                                            <select class="form-control" id="productTag" name="search_tag">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>                                                    
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-dark mt-2">絞り込み</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-10">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            @include('commons.footer')
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS, then Font Awesome -->
        @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        @show
    </body>
</html>
