# laravel11-template  
## git clone  
1. ディレクトリ以下に、laravel11-template.gitをクローンしてリポジトリ名を好きな名前に変更  
cd ディレクトリ  
git clone git@github.com:yuri52-star/laravel11-template.git  
mv laravel11-template 好きな名前  
2. 変更先(好きな名前)のリモートリポジトリをpublicで作成  
3. ローカルリポジトリから紐付け先を変更.作成したリポジトリから url を取得して、以下のコマンドを実行  
cd 好きな名前  
git remote set-url origin 作成したリポジトリのurl  
git remote -v  
最後のコマンドで、変更先の url が表示されれば成功  
4. 現在のローカルリポジトリのデータをリモートリポジトリに反映させる  
git add .  
git commit -m "リモートリポジトリの変更"  
git push origin main  
エラーが発生する場合は、 sudo chmod -R 777 *  

## git cloneしたらやること  
docker-compose up -d --build  
docker-compose exec php bash  
composer install  
.env ファイルの作成  
cp .env.example .env  
テキストを参照
データベースが存在しているかを確認  
アプリケーションキーの作成  
php artisan key:generate  
マイグレーションの実行  
php artisan migrate  
　　
### 覚書  
@vite使用の際は、src下でnpm run devをすること  
(その前にnpm installする)  
fortifyについて  
config/app.php にプロバイダー登録を追加 --→　bootstrap/providers.phpに変更  
RouteServiceProvider はデフォルトでは存在しない 
login成功後のページ移動先はFortifyServiceProvider の boot() メソッドで設定  
確認用パスワードがないときはPasswordValidationRules.phpの'confirmed' を削除する  
config/fortify.phpの'home' => '/home',を修正する（認証成功後飛びたいところに）　　
web.phpで設定  
Route::get('/', function () {  

  if(auth()->check()) {  
    return redirect('/admin');
    }  
    return redirect('/login');
  });
  予備のlogout機能が必要になったとき、web.phpにて  
  use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;とインポート  
  Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');コントローラは不要　  
   ログアウトボタンは   
   form method="POST" action="{{ route('logout') }}"    
   @csrf  
   button type="submit">Logout/button  
   /form
  「ログアウト後は必ず / に戻る」仕様になっている   
    / のルーティングを直せば、必ずログイン画面に行く  
  / を「ログイン画面」にする  
  ただし、form の action だけは変えない  
  ログイン処理の POST 先は /login 固定    
  / は GET 専用の振り分けルート  
  FortifyServiceProvider.php の  

Fortify::authenticateUsing(function ($request) { ~ }はそのまま使用
### 課題  
ルーティングを仕様書通りにするならCustomLogoutResponseを作成 (LoginResponse / RegisterResponse と混ぜない) 
1.クラスを作成  
php artisan make:class App/Http/Responses/LogoutResponse  

 <?php  


namespace App\Http\Responses;  


use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;  


class LogoutResponse implements  
 LogoutResponseContract  

{
    public function toResponse($request)  

    {
        return redirect('/login');  

    }
}  

2. FortifyServiceProvider でバインド   

use Laravel\Fortify\Contracts\LogoutResponse;  
use App\Http\Responses\LogoutResponse as CustomLogoutResponse;  
public function boot(): void  
{
  $this->app->singleton(LogoutResponse::class,
    CustomLogoutResponse::class);  
  Fortify::authenticateUsing(function ($request) {  

    $user = \App\Models\User::where('email', $request->email)->first();  

    if ($user && \Hash::check($request->password, $user->password)) {  

            return $user;  

        }

        return null;  

    });  


    Fortify::loginView(fn () => view('login'));  

    Fortify::registerView(fn () => view('register'));  

}

バリデーションの日本語化  
composer require laravel-lang/lang:~7.0 --dev(Laravel8の時)  
これをインストールしてもjaディレクトリが作られない
composer require laravel-lang/publisher --dev （代わりにこちらでもいいかも）そのあとで
php artisan lang:add ja　　
php artisan lang:update  
だが、実際やったコマンドは別  
phpコンテナ内でmkdir -p resources/lang/ja  
cp -r vendor/laravel-lang/lang/src/ja/* resources/lang/ja/  

config/app.php の locale / fallback_locale  
両方とも'ja'にする  
キャッシュクリア  
php artisan config:clear  
php artisan cache:clear  
日本語ファイルはcustomが反映されないとのこと（fortifyの時）  
よってLoginRequestにエラー文を記入  
Request を差し替える  
$this->app->bind(FortifyLoginRequest::class, LoginRequest::class);
FortifyServiceProviderの記述はわすれないこと  use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;　　
use App\Http\Requests\LoginRequest;　こちらのインポートも  
キャッシュクリアも忘れずに  
登録画面ではRegisterRequestは使われないので、App\Actions\Fortify\CreateNewUser.php を編集  



