@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="wrapper">
        <h1 class="message">Thank you</h1>
        <p>お問い合わせありがとうございました</p>
        <a href="/" class="to-home">HOME</a>
    </div>
@endsection 