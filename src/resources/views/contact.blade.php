<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問いあわせページ</title>
</head>
<body>
    <header id="header">
        <h1 class="site-title">FashionablyLate</h1>
    </header>
    <main>
        <h2 class="page-title">Contact</h2>

        <div class="wrapper">
            <form action="/confirm" class="" 
            method="post">
            <!-- フォーム内容の送信先を指定 -->
                @csrf
                <!-- ================================== -->

                <!-- name属性には、inputタグ に入力される情報のキーを設定します -->

                <!-- キーというのは、情報を識別するためのラベルのようなもので、キーと値は 1 対 1 の対応関係にあります。 -->

                <!-- キーは、特定の情報を取得したいときに利用されます。 -->
                <label for="" class="tab">お名前<span>※</span></label>
                <div class="name">
                    <input type="text" class="name-input first-name" name="first_name" placeholder="例:山田"value="{{ old('first_name') }}">
                    <input type="text" class="name-input last-name" name="last_name" placeholder="例:太郎"value="{{ old('last_name') }}">
                </div>
             <!-- ================================== -->
                <label for="" class="tab">性別<span>※</span></label>
                <div class="gender">
                    <input type="radio" class="radio" name="gender" value="1" {{ old('gender')==1 || old('gender')==null ? 'checked' : '' }}>男性
                    <input type="radio" name="gender" class="radio" value="2" {{ old('gender')==2 ? 'checked' : '' }}>女性
                    <input type="radio" name="gender" class="radio" value="3" {{ old('gender')==3 ? 'checked' : '' }}>その他
                </div>
             <!-- ================================== -->
                <label for="" class="tab">メールアドレス<span>※</span></label>
                <input type="email" class="email" value="{{ old('email') }}" name="email" placeholder="test@example.com">
             <!-- ================================== -->
                <label for="" class="tab">電話番号<span>※</span></label>
                    <div class="tel">
                        <input type="tel" name="tel_1" class="tel-input" placeholder="123"   value="{{ old('tel_1') }}">
                        <input type="tel" class="tel-input" placeholder="456" name="tel_2"value="{{ old('tel_2') }}">
                        <input type="tel" class="tel-input" placeholder="789" name="tel_3"value="{{ old('tel_3') }}">
                    </div>
                
             <!-- ================================== -->
                <label for="" class="tab">住所<span>※</span></label>
                    <input type="text" class="address"name="address" placeholder="例:東京都銀座1丁目" value="{{ old('address') }}">
                
             <!-- ================================== -->
                <label for="" class="tab">建物名</label>
                    <input type="text" class="building" name="building" value="{{ old('building') }}" placeholder="例:吾川佐マンション">
                
             <!-- ================================== -->
                <label for="" class="tab">お問い合わせの種類<span>※</span></label>
                    <div class="select">
                        <!-- ここがおかしくてエラー続き -->
                        <select name="category_id" id="" class="select-box">
                            <option value="">選択してください</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ old('category_id')==$category->id ? 'selected' : '' }}>{{ $category->content}}</option>
                            @endforeach
                        </select>
                    </div>
                        
             <!-- ================================== -->
                <label for="" class="tab">お問い合わせ内容<span>※</span></label>
                <textarea name="detail" id="" placeholder="お問い合わせ内容をご記入ください">{{ old('detail') }}</textarea>
             <!-- ================================== -->
                <div class="btn">
                    <button class="to-confirm">確認画面</button>
                </div>
            </form>
        </div>
    </main>    

</body>

</html>