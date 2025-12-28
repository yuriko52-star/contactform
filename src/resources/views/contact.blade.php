@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
    <div class="wrapper">
        <h2 class="page-title">Contact</h2>
            <form action="/confirm" class="" 
            method="post">
            @csrf  
                <div class="form-group">
                    <label for="" class="tab">お名前<span>※</span></label>
                    <div class="name">
                        <input type="text" class="name-input first-name" name="first_name" placeholder="例:山田"value="{{ old('first_name') }}">
                        
                        <input type="text" class="name-input last-name" name="last_name" placeholder="例:太郎"value="{{ old('last_name') }}">
                    </div> 
                    <div class="error">
                            @error('first_name')
                            {{ $message }}
                            @enderror
                    </div>
                    <div class="error">
                            @error('last_name')
                            {{ $message}}
                            @enderror
                    </div>   
                </div>
                        
             <!-- gender================================== -->
                <div class="form-group">
                    <label for="" class="tab">性別<span>※</span></label>
                    <div class="gender">
                        <input type="radio" class="radio" name="gender" value="1" {{ old('gender')==1  ? 'checked' : '' }}>男性
                        <input type="radio" name="gender" class="radio" value="2" {{ old('gender')==2 ? 'checked' : '' }}>女性
                        <input type="radio" name="gender" class="radio" value="3" {{ old('gender')==3 ? 'checked' : '' }}>その他
                    </div>
                    <div class="error">
                        @error('gender')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
             <!-- email================================== -->
                <div class="form-group">
                    <label for="" class="tab">メールアドレス<span>※</span></label>
                    <input type="email" class="email" value="{{ old('email') }}" name="email" placeholder="test@example.com">
                    <div class="error">
                        @error('email')
                        {{ $message}}
                        @enderror
                    </div>
                </div>
             <!-- tel================================== -->
                <div class="form-group">
                    <label for="" class="tab">電話番号<span>※</span></label>
                    <div class="tel">
                        <input type="tel" name="tel_1" class="tel-input" placeholder="123"   value="{{ old('tel_1') }}"><span>-</span>
                        

                        <input type="tel" class="tel-input" placeholder="456" name="tel_2"value="{{ old('tel_2') }}"><span>-</span>
                        
                        
                        <input type="tel" class="tel-input" placeholder="789" name="tel_3"value="{{ old('tel_3') }}">

                    </div>
                    <div class="error">
                        @error('tel_2')
                        {{ $message}}
                        @enderror
                    </div>
                    <div class="error">
                        @error('tel_1')
                        {{ $message}}
                        @enderror
                    </div>
                    <div class="error">
                        @error('tel_3')
                        {{ $message}}
                        @enderror
                    </div>
                </div>
             <!-- address================================== -->
                <div class="form-item">
                    <label for="" class="tab">住所<span>※</span></label>
                        <input type="text" class="address"name="address" placeholder="例:東京都銀座1丁目" value="{{ old('address') }}">
                    <div class="error">
                    @error('address')
                        {{ $message}}
                        @enderror
                    </div>
                </div>
             <!-- building================================== -->
                <div class="form-item">
                    <label for="" class="tab">建物名</label>
                        <input type="text" class="building" name="building" value="{{ old('building') }}" placeholder="例:吾川佐マンション">
                </div>
            <!-- content================================== -->
                <div class="form-select">
                    <label for="" class="tab">お問い合わせの種類<span>※</span></label>
                    <div class="select">
                        <!-- ここがおかしくてエラー続き -->
                        <select name="category_id" id="" class="select-box">
                        <option value=""disabled selected hidden>選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" {{ old('category_id')==$category->id ? 'selected' : '' }}>{{ $category->content}}
                        </option>
                        @endforeach
                        </select>

                        <div class="error">
                        @error('category_id')
                        {{ $message}}
                        @enderror
                        </div>
                    </div>
                </div>
                        
             <!-- detail================================== -->
                <div class="form-item">
                    <label for="" class="tab">お問い合わせ内容<span>※</span></label>
                    <textarea name="detail"  placeholder="お問い合わせ内容をご記入ください"></textarea>

                    <div class="error">
                    @error('detail')
                        {{ $message}}
                        @enderror
                    </div>
                </div>
             <!-- submit================================== -->
               <div class="form-item">
                    <input type="submit" class="to-confirm" value="確認画面">
                </div>
            </form>
            </div>
        </div>
    @endsection