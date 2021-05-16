<header class="shop-header">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('index') }}">stweb_shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto"></ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link nav-list-item" href="{{ route('admin_index') }}">管理画面TOP</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-list-item" href="{{ route('admin_product_index') }}">商品一覧</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-list-item" href="{{ route('admin_tag_index') }}">タグ一覧</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-list-item" href="#">受注一覧</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            メニュー
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <div class="dropdown-item" >{{ Auth::user()->last_name . ' ' .Auth::user()->first_name }}</div>
            <hr>
            <a class="dropdown-item nav-list-item" href="{{ route('logout') }}">ログアウト</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>
