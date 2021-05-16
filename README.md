# stweb_shop

## 環境
* PHP 7.4.15
* Laravel 6.20
* MySQL 8.0.23

### 環境構築
1. 本リポジトリをgit clone
2. ルートディレクトリ直下に.envファイルを設置

例）

```
WEB_PORT=80
DB_PORT=3306
DB_NAME=sample_name
DB_USER=sample
DB_PASS=sample
```
3. `docker-compose up -d`でコンテナ起動
4. `docker exec -it php_コンテナ名 bash`でコンテナ内へ
5. `backend`ディレクトリにて以下のコマンド実行
```
$ composer install
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ php artisan make:user {count}
$ php artisan make:product {count}
$ php artisan make:order {count}
```
  
## データ数
* ユーザー:  100万件
* 商品:  30万件
* 注文データ:  1000万件

## データ作成コマンド
* `php artisan make:user {count}`
* `php artisan make:product {count}`
* `php artisan make:user {count}`

## テストアカウント
### 管理者権限持ち
|email|pass|
|--|--|
|admin0@admin.com|test1234|
|admin1@admin.com|test1234|
|admin2@admin.com|test1234|
|admin3@admin.com|test1234|
|admin4@admin.com|test1234|

### 一般権限
新規登録画面にて作成ください。

## 未実装
### 必須処理
* 全文検索（Laravel Scout × ElasticSearch）

### 未実装の処理(本来実装必要不可欠)
* 各種フォームのバリデーション
