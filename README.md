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
  （例）Fortify::redirects('login', '/dashboard');  
ログアウト後や登録後のリダイレクトも設定できる  
（例）Fortify::redirects('register', '/welcome');  
Fortify::redirects('logout', '/');  

  
