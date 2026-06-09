<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7); // お問い合わせ一覧を7件ずつ取得

        $categories = Category::all(); // 検索フォームのお問い合わせ種類で使う

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete(); // 該当するお問い合わせデータを削除

        return redirect()->route('admin.index');
    }

    public function search(Request $request)
    {
        $query = Contact::with('category');

        if ($request->keyword) {
            $keyword = $request->keyword; // 名前とメールアドレスのキーワード検索

            $query->where(function ($query) use ($keyword) {
                $query->where('last_name', 'like', '%' . $keyword . '%') // 姓検索
                    ->orWhere('first_name', 'like', '%' . $keyword . '%') // 名検索
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $keyword . '%']) // フルネーム検索
                    ->orWhere('email', 'like', '%' . $keyword . '%'); //メールアドレス検索
            });
        }

        if ($request->gender && $request->gender !== 'all') { // 性別検索（全て、男性、女性、その他）
            $query->where('gender', $request->gender);
        }

        if ($request->categry_id) {
            $query->where('categry_id', $request->categry_id); // お問い合わせの種類検索　仕様書のカラム名 categry_id
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date); // 日付(created_at)検索
        }

        $contacts = $query->paginate(7)->appends($request->query()); //検索結果を7件ずつページネーション、appends()で、ページ移動後も検索条件を維持

        $categories = Category::all(); // 検索フォームのお問い合わせ種類selectで使う

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function reset()
    {
        return redirect()->route('admin.index'); // リセットボタンで管理画面の初期表示へ戻す
    }

    public function export(Request $request)
    {
        $query = Contact::with('category'); // 検索結果と同じ条件で絞り込めるように準備(検索の土台)

        if ($request->keyword) {
            $keyword = $request->keyword; // 名前とメールアドレスのキーワード検索

            $query->where(function ($query) use ($keyword) {
                $query->where('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $keyword . '%')
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $keyword . '%'])
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->gender && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->categry_id) {
            $query->where('categry_id', $request->categry_id);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get(); // CSVに出力するデータ(検索条件に合致する全件)を取得

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w'); // ブラウザにCSVとして出力するための準備

            fputs($file, "\xEF\xBB\xBF"); // Excelで文字化けしないようにBOMを付ける

            foreach ($contacts as $contact) { // CSV用に文字へ変換する
                if ($contact->gender == 1) {
                    $gender = '男性';
                } elseif ($contact->gender == 2) {
                    $gender = '女性';
                } else {
                    $gender = 'その他';
                }

                fputcsv($file, [ // CSVに1行分のデータを書き込む
                    $contact->last_name,
                    $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content,
                    $contact->detail,
                ]);
            }

            fclose($file); // CSV出力を終了する
        };

        return response()->streamDownload($callback, 'contacts.csv'); // contacts.csvという名前でCSVファイルをダウンロードする
    }
}