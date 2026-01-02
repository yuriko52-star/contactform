<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- これがないとdeleteできなくてエラーになるよ -->
    <title>FashionablyLate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/ress.dist/ress.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header id="header">
        <h1 class="site-title">FashionablyLate</h1>
     @yield('link')   
    </header>
    <main>
       @yield('content') 
    </main>
    
</body>
</html>