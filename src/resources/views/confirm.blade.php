<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認ページ</title>
</head>
<body>
    <header id="header">
        <h1 class="site-title">FashionablyLate</h1>
    </header>
    <main>
        <h2 class="page-title">Confirm</h2>

        <div class="wrapper">
            <form action="/contacts" class="" method="post">
                @csrf
                <table>
                    <tr>
                        <th>お名前</th>
                        <td>{{ $contacts['first_name']}}
                            &nbsp;{{ $contacts['last_name']}}
                        </td>
                       <input type="hidden" name="first_name" value="{{$contacts['first_name']}}"> 
                        <input type="hidden" name="last_name" value="{{$contacts['last_name']}}">
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td>
                            @if($contacts['gender']==1)
                            男性
                            @elseif($contacts['gender']==2)
                            女性
                            @else 
                            その他
                            @endif
                        </td>
                        <!-- ラジオボタンからinputにするには どうするか？-->
                         <input type="hidden" name="gender" value="{{ $contacts['gender']}}"> 
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>{{ $contacts['email']}}"</td>
                         <input type="hidden" name="email" value="{{$contacts['email']}}"> 
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $contacts['tel_1']}}{{ $contacts['tel_2']}}{{ $contacts['tel_3']}}</td>
                        <input type="hidden" name="tel_1" value="{{$contacts['tel_1']}}"> 
                        <input type="hidden" name="tel_2" value="{{$contacts['tel_2']}}">
                        <input type="hidden" name="tel_3" value="{{$contacts['tel_3']}}">  
            
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>{{ $contacts['address']}}</td>
                        <input type="hidden" name="address" value="{{$contacts['address']}}"> 
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td>{{ $contacts['building']}}</td>
                        <input type="hidden" name="building" value="{{$contacts['building']}}"> 
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td>{{ $category->content}}</td>
                       
                         <input type="hidden" name="category_id" value="{{ $contacts['category_id'] }}">

                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td>{{$contacts['detail']}}
                        </td>
                         <input type="hidden" name="detail" value="{{$contacts['detail']}}"> 
                    </tr>

                </table>
                <div class="btns">
                    <button class="to-send">送信</button>
                    <!-- <a href="/" class="edit-btn">修正</a> -->
                    <input type="submit" class="update" name="back" value="修正">
                </div>
            </form>
        </div>
    </main>    
</body>
</html>