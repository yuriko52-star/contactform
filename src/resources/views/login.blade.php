@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('link')
    
        <div class="to-register">
            <a href="/register" class="link">register

            </a>
        </div>
@endsection

@section('content')
<div class="content">
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
        </div>
    @endsection