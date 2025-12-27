<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index () {
        $categories = Category::all();
        return view('contact',compact('categories'));
    }
    public function confirm(ContactRequest $request) {
        // フォーム入力ページから送られた入力内容を、入力内容確認ページに表示する処理
        // formタグから送られてきた値を取り出す
        // Request クラスを利用 
       
         $contacts = $request->all();
        
        // セレクトボックスから一つを選択するので、findを使う
        $category = Category::find($request->category_id);
        // dd($request->category_id);
        return view('confirm',compact('contacts', 'category'));

        // view ファイルに渡す値は、view メソッドの第 2 引数に連想配列で指定
    }
    public function store(ContactRequest $request) {
        if($request->has('back')) {
            return redirect('/')->withInput();
        }
        
       
         // 実際に値を取り出す処理を記述 値を取り出すためには、$request->only(['キー', 'キー']); と記述.
        //  「キー」には、view ファイル内 inputタグ の name 属性で指定した文字を記述
        $contact = $request->only(['first_name','last_name', 'gender', 'email','address','building','category_id', 'detail']);
        $contact['tel_1'] = $request->tel_1;
        $contact['tel_2'] = $request->tel_2;
        $contact['tel_3'] = $request->tel_3;

         // 電話番号を結合
        
         $contact['tel'] = $contact['tel_1'] . $contact['tel_2'] .  $contact['tel_3'];
        // contact.blade.phpで３つに分けた番号をひとつにする
        // contentはcategoriesテーブルのカラムだから外部キーのcategory_idを代わりに使う
        // Contact モデルを使った、データの保存処理のコードを記述
        Contact::create($contact);
        
        return view('thanks');
    }
    public function admin() {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        
        return view('admin', compact('contacts', 'categories'));
       
    }
    
    public function search(Request $request)
    {
        if($request->has('reset')) {
            // return redirect('/admin')->withInput();
            return redirect('/admin');
        }
        $query = Contact::query();
        $query = $this->getSearchQuery($request, $query);
        $contacts = $query->paginate(7)->withQueryString();
        $categories = Category::all();
        
        return view('admin', compact('contacts', 'categories'));
        
    }

    private function getSearchQuery($request,$query)
    {
        if(!empty($request->keyword)) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'LIKE', '%'. $request->keyword . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $request->keyword . '%');
            });
        }
        if(!empty($request->gender)) {
            $query->where('gender', $request->gender);
        }
        if(!empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }
        if(!empty($request->date)) {
            $query->whereDate('created_at', $request->date);
        }
        return $query;
    }
    public function show(Contact $contact)
    {
        $genderText = match($contact->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        };
        return response()->json([
            'first_name' => $contact->first_name,
            'last_name' => $contact->last_name,
            'email' => $contact->email,
            'tel' => $contact->tel,
            'gender' => $genderText,
            'address'=>$contact->address,
            'building' => $contact->building,
            'category'=> $contact->category->content,
            'detail'=> $contact->detail,

        ]);
    }
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json([
            'success' => true
        ]);
    }
    public function export(Request $request)
    {
        $query = Contact::query();
        $query = $this->getSearchQuery($request, $query);
        $contacts = $query->get();
        $headers = [
            'Content-Type' => 'text/csv; charset=SJIS-win',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];
        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            $header = ['ID','カテゴリ','姓','名','性別','メール','電話',
            '住所','建物','内容','作成日','更新日'];
            mb_convert_variables('SJIS-win', 'UTF-8', $header);
            fputcsv($handle, $header);
            foreach($contacts  as $contact) {
                $row = [
                    $contact->id,
                    $contact->category_id,
                    $contact->first_name,
                    $contact->last_name,
                    match($contact->gender) {
                        1 =>'男性',
                        2 => '女性',
                        3 => 'その他',
                    },
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->detail,
                    $contact->created_at->format('Y/m/d H:i:s'),
                    $contact->updated_at->format('Y/m/d H:i:s'),
                ];
                mb_convert_variables('SJIS-win', 'UTF-8', $row);
                fputcsv($handle, $row);
            }
            fclose($handle);
        };
        return response()->stream($callback,200,$headers);
    }
}
  
