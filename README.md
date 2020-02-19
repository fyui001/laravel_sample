# installation

cloneしたらプロジェクトディレクトリの中で以下のコマンドを上から順番に実行する
```shell script
composer install
```
```shell script
yarn
```
```shell script
cp .env.example .env
```
```shell script
php artisan key:generate
```
```shell script
php artisan migrate:refresh --seed
```

# だいたいの説明
.envファイルは.gitignoreなので.env.exampleからコピーして
`php artisan key:generate`を実行する

### ルーティング
routerでアクセス可能なURLを設定しないと全部404になる
laravel内で作るならrouters/web.phpで設定する
apiとして使うならrouters/api.phpで設定する。api.phpで設定したURLは全部
`http://example.com/api`からはじまる


### コントローラー
controllerはapp/Http/Controllers配下に設置。
ここらへんは他のフレームワークと同じ感じ

`app/Http/Controllers/PostCodeController.php`

### モデル
modelの設置場所はデフォルトだとappの直下だけど、app/Modelみたいにディレクトリを掘ることが多い
※ディレクトリを掘るときはちゃんとnamespaceもいい感じにしないとダメ

`app/Model/PostCodeModel.php`

### ビュー
viewファイルはresources/views配下に設置。
ファイル名末尾が.blade.phpじゃないとbladeが仕事してくれない

`resources/views/Postcode/index.blade.php`

LaravelのデフォルトでCSRF対策が有効なので
<meta name="csrf-token" content="{{ csrf_token() }}">
は不要でも書いておくと良い（ajaxで通信したいときとかにcsrf_tokenを使う）

jsとcssはここにおいておけばおｋ
public/js
public/css

### バリデーション
コントローラーの中でリクエストされたデータをバリデーションするのは美しくないのでリクエストを作って
その中でやる。作るときはArtisan CLIコマンドで
```shell script
php artisan make:request PostCodeRequest
```
を実行するとapp/Http/Requestsディレクトリが勝手にできて中でファイルが作られるのでそこに書いていく

※今回は作ってあるので上のコマンドそのまま打たなくて大丈夫
`app/Http?Requests/PostCodeRequest.php`
