<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header id="header">
        <h1 class="site-title">FashionablyLate</h1>
        <div class="to-login"><a href="/register" class="link">register</a></div>
    </header>
    <main>
        <h2 class="page-title">Login</h2>

        <div class="wrapper">
            <form action="/login" method="post">
                @csrf
                <label for="" class="tab">メールアドレス</label>
                <input type="text" class="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}">
                <p class="error">
                    @error('email')
                    {{ $message}}
                    @enderror
                </p>
                 <!-- ================================= -->
                <label for="" class="tab">パスワード</label>
                <input type="password" name="password" class="password" placeholder="例:asdfghj" value="">
                <p class="error">
                    @error('password')
                    {{ $message}}
                    @enderror
                </p>
                 <!-- ================================= -->
                <input type="submit" class="btn" value="ログイン">
            </form>
        </div>
    </main>
</body>
</html>    