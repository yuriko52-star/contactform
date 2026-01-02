@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('link')
        <div class="to-login"><a href="/login" class="link">login</a></div>
@endsection

@section('content')
    <div class="content">
        <h2 class="page-title">Register</h2>

        <div class="wrapper">
            <form action="/register" method="post">
                @csrf
                <label for="" class="tab">お名前</label>
                <input type="text" class="name" name="name" placeholder="例:山田　太郎" value="{{ old('name') }}">
                <p class="error">
                    @error('name')
                    {{ $message}}
                    @enderror
                </p>
                <!-- ================================= -->
                <label for="" class="tab">メールアドレス</label>
                <input type="text" class="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}">
                <p class="error">
                    @error('email')
                    {{ $message}}
                    @enderror
                </p>
                 <!-- ================================= -->
                <label for="" class="tab">パスワード</label>
                <input type="password" class="password" name="password" placeholder="例:asdfghj" value="">
                <p class="error">
                    @error('password')
                    {{ $message}}
                    @enderror
                </p>
                 <!-- ================================= -->
                <input type="submit" class="btn" value="登録">
            </form>
        </div>
    </div>
@endsection     