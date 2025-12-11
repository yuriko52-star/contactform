<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理ページ</title>
</head>
<body>
    <header id="header">
        <h1 class="site-title">FashionablyLate</h1>
    </header>
    <main>
        <h2 class="page-title">Admin</h2>

        <div class="wrapper">
            <form action="" class="">
                <div class="search-item">
                    <input type="text" class="search-input" placeholder="名前やメールアドレスを入力してください">
                    <select name="" id="" class="age">
                        <option value="">性別</option>
                        <option value="">男性</option>
                        <option value="">女性</option>
                        <option value="">その他</option>
                    </select>
                    <select name="" id="" class="contact-item">
                         <option value="">お問い合わせの種類</option>
                            <option value="">商品のお届けについて</option>
                            <option value="">商品の交換について</option>
                            <option value="">商品トラブル</option>
                            <option value="">ショップへのお問い合わせ</option>
                            <option value="">その他</option>
                    </select>
                    <input type="date" class="date" placeholder="年/月/日">
                    <button class="search-btn">検索</button>
                    <button class="reset-btn">リセット</button>
                </div>
                </form>
                <div class="flex-item">
                    <button class="export">エクスポート</button>
                    <div class="pagenation"></div>
                </div>
                <table>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>山田　太郎</td>
                        <td>男性</td>
                        <td>test@example.com</td>
                        <td>商品の交換について</td>
                        <td><button class="deetail">詳細</button></td>

                    </tr>
                </table>
            
        </div>
    </main> 
</body>
</html>         