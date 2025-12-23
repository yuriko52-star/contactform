<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- これがないとdeleteできなくてエラーになるよ -->
    <title>管理ページ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header id="header">
        <h1 class="site-title">FashionablyLate</h1>
        <form action="" class="">
            <button class="logout">ログアウト</button>
        </form>
    </header>
    <main>
        <h2 class="page-title">Admin</h2>

        <div class="wrapper">
            <form action="/search" method="get">
                @csrf
                <div class="search-item">
                    <input type="text" name="keyword" class="search-input item" placeholder="名前やメールアドレスを入力してください"value="{{ request('keyword') }}">

                    <select name="gender" class="age item" value="{{ request('gender') }}">
                        <option disabled selected>性別</option>
                        
                        <option value="1" @if( request('gender')==1) selected @endif>男性</option>
                        <option value="2"  @if( request('gender')==2) selected @endif>女性</option>
                        <option value="3"  @if( request('gender')==3) selected @endif>その他</option>
                    </select>
                    <select name="category_id" class="contact-item item">
                         <option disabled selected>お問い合わせの種類</option>
                         @foreach($categories as $category)
                         <!-- エラーが出たらあとで調整 -->
                            <option value="{{ $category->id }}" @if( request('category_id')==$category->id) selected @endif>{{ $category->content }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="date" class="date item" placeholder="年/月/日" value="{{ request('date') }}">
                    <button class="search-btn item">検索</button>
                    <button class="reset-btn item" name="reset">リセット</button>
                </div>
                </form>
                <div class="flex-item">
                    <form action="{{ route('contacts.export',request()->query()) }}" method="post">
                        @csrf
                        <button type="submit"class="export item">エクスポート
                        </button>
                    </form>
                    
                    {{ $contacts->links('vendor.pagination.default') }}
                    
                </div>
                <table>
                    <colgroup>  
                        <col style="width: 300px;">
                        <col style="width: 250px;">
                        <col style="width: 400px;">
                        <col style="width: 400px;">
                        <col style="width: 100px;">
                        
                    </colgroup>
                    
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th></th>
                    </tr>
                    @foreach($contacts as $contact)
                    <tr data-id="{{ $contact->id }}">
                        <td>{{ $contact->first_name }}&nbsp {{ $contact->last_name }}</td>
                        <td>
                            @if($contact->gender==1)
                            男性
                            @elseif($contact->gender==2)
                            女性
                            @else
                            その他
                            @endif
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content }}</td>
                        <td>
                            <a href="#" class="detail-link" data-id="{{ $contact->id }}"data-url = "{{ route('contacts.show', $contact) }}">詳細</a>
                            
                        </td>

                    </tr>
                    
                    @endforeach
                </table>
             <div id="modal" class="modal hidden">
                        <div class="modal-content">
                           
                            <dl>
                                <dt>お名前</dt>
                                <dd id="modal-name"></dd>
                                <dt>性別</dt>
                                <dd id="modal-gender"></dd>
                                <dt>メールアドレス</dt>
                                <dd id="modal-email"></dd>
                                <dt>電話番号</dt>
                                <dd id="modal-tel"></dd>
                                <dt>住所</dt>
                                <dd id="modal-address"></dd>
                                <dt>建物名</dt>
                                <dd id="modal-building"></dd>
                                <dt>お問い合わせの種類</dt>
                                <dd id="modal-category"></dd>
                                <dt>お問い合わせ内容</dt>
                                <dd id="modal-detail"></dd>
                            </dl>
                            

                            <button id="deleteBtn"class="delete" data-id="">削除</button>
                            
                            <button id="closeModal" class="close">C</button>
                        </div>
        </div>
    </main>
    @vite(['resources/js/app.js'])
</body>
</html>         
          