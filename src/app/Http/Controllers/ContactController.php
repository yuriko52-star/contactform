<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index () {
        $categories = Category::all();
        return view('contact',compact('categories'));
    }
    // 入力内容確認ページ」に入力内容を表示するためには、「フォーム入力画面」で入力された内容を保持する処理が必要です。
    // フォームに入力された値を controller に渡す処理を作成しましょう。
    // 入力情報を controller に渡すことで、他の view ファイルでの入力内容の表示や、入力内容をデータベースに保存することができるようになります。

    // 値をコントローラに送るためには、formタグと inputタグ（textareaタグ）を使います

    // formタグの method属性とaction属性を設定し、confirmアクションを呼び出すルーティングと結びつけるようにしましょう。
    public function confirm(Request $request) {
        // フォーム入力ページから送られた入力内容を、入力内容確認ページに表示する処理
        // formタグから送られてきた値を取り出す
        // Request クラスを利用 
        // 実際に値を取り出す処理を記述 値を取り出すためには、$request->only(['キー', 'キー']); と記述.
        //  「キー」には、view ファイル内 inputタグ の name 属性で指定した文字を記述
         $contacts = $request->all();
         // 電話番号を結合
    // $contact['tel'] = $contact['tel_1'] . $contact['tel_2'] . $contact['tel_3'];


         // セレクトボックスから一つを選択するので、findを使う
        $category = Category::find($request->category_id);
        // dd($request->category_id);
        return view('confirm',compact('contacts', 'category'));
        // view ファイルに渡す値は、view メソッドの第 2 引数に連想配列で指定
        // view ファイル側で連想配列のキーを指定することで、そのキーに対応した値を表示することができます。

        
    }
    public function store(Request $request) {
        if($request->has('back')) {
            return redirect('/')->withInput();
        }
        /*$request['tel'] = $request->tel_1 . $request->tel_2 . $request->tel_3;
    
       Contact::create(
        $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
        ])
        );
        */
        $contact = $request->only(['first_name','last_name', 'gender', 'email','address','building','category_id', 'detail']);
        $contact['tel_1'] = $request->tel_1;
        $contact['tel_2'] = $request->tel_2;
        $contact['tel_3'] = $request->tel_3;
        
         $contact['tel'] = $contact['tel_1'] . $contact['tel_2'] .  $contact['tel_3'];
        // contact.blade.phpで３つに分けた番号をひとつにする
        // contentはcategoriesテーブルのカラムだからga外部キーのcategory_idを代わりに使う
        // Contact モデルを使った、データの保存処理のコードを記述
        Contact::create($contact);
        
        return view('thanks');
    }
    
}
