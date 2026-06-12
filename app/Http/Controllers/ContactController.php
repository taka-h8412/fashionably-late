<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated(); // バリデーション済みの入力内容を取得

        $contact['tel'] = $request->tel1.$request->tel2.$request->tel3; // 3分割された電話番号を1つにまとめる

        $category = Category::find($request->categry_id); // 選択されたお問い合わせ種類を取得

        return view('contact.confirm', compact('contact', 'category')); // 確認画面にフォーム内容、お問い合わせ種類を渡す
    }

    public function store(Request $request)
    {
        Contact::create([
            'categry_id' => $request->categry_id, // 仕様書のカラム名 categry_id
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'building' => $request->building,
            'detail' => $request->detail,
        ]);

        return view('contact.thanks');
    }
}
