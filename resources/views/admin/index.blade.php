@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<style>
    /* 管理画面では共通レイアウトの横幅を広げる */
    .content {
        max-width: 1200px;
    }

    /* 管理画面全体と中央寄せ */
    .admin {
        width: 1100px;
        margin: 0 auto;
    }

    /* テーブル上部にエクスポートとページネーションを左右配置する */
    .admin-table-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    /* 一覧テーブル全体 */
    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    /* 一覧テーブルの見出し行 */
    .admin-table th {
        padding: 12px;
        background-color: saddlebrown;
        color: white;
        text-align: left;
    }

    /* 一覧テーブルのデータ行 */
    .admin-table td {
        padding: 12px;
        border-bottom: 1px solid gainsboro;
    }

    /* 要件：テーブル行にカーソルが乗った時にhover */
    .admin-table tbody tr:hover {
        background-color: whitesmoke;
    }

    /* 詳細ボタン */
    .detail-button {
        display: inline-block;
        padding: 6px 16px;
        border: 1px solid tan;
        background-color: snow;
        color: brown;
        cursor: pointer;
    }

    /* エクスポートボタンエリア */
    .export-area {
        text-align: left;
    }

    /* エクスポートボタン */
    .export-button {
        display: inline-block;
        padding: 8px 24px;
        background-color: wheat;
        color: brown;
        text-decoration: none;
    }

    /* ページネーションを右側に配置する */
    .pagination {
        text-align: right;
    }

    /* ページネーションの矢印サイズ調整 */
    .pagination svg {
        width: 20px;
        height: 20px;
    }

    /* モーダル開閉用のチェックボックスは非表示 */
    .modal-checkbox {
        display: none;
    }

    /* モーダル全体 */
    .modal {
        display: none;
    }

    /* チェックが入ったらモーダルを表示 */
    .modal-checkbox:checked + .modal {
        display: block;
    }

    /* モーダル画面全体の薄い背景 */
    .modal-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: gainsboro;
        opacity: 0.7;
        z-index: 5;
    }

    /* モーダル本体 */
    .modal-content {
        position: fixed;
        top: 60px;
        left: 50%;
        width: 700px;
        padding: 30px;
        background-color: white;
        transform: translateX(-50%);
        z-index: 10;
    }

    /* 右上の閉じるボタン */
    .modal-close {
        position: absolute;
        top: 20px;
        right: 25px;
        width: 28px;
        height: 28px;
        border: 1px solid tan;
        border-radius: 50%;
        color: brown;
        text-align: center;
        line-height: 26px;
        cursor: pointer;
    }

    /* モーダル内の詳細項目を横並びにする */
    .modal-row {
        display: flex;
        margin-bottom: 15px;
    }

     /* モーダル内の項目名 */
    .modal-label {
        width: 200px;
        font-weight: bold;
    }

    /* モーダル内の表示内容 */
    .modal-text {
        width: 500px;
    }

    /* 削除ボタンエリア */
    .delete-button-area {
        margin-top: 40px;
        text-align: center;
    }

    /* 削除ボタン */
    .delete-button {
        padding: 10px 30px;
        border: none;
        background-color: firebrick;
        color: white;
        cursor: pointer;
    }

    /* 検索フォーム全体を横並びにする */
    .search-form {
        display: flex;
        gap: 15px;
        width: 100%;
        margin-bottom: 20px;
        padding: 0;
        border: none;
        box-sizing: border-box;
    }

    /* 名前・メールアドレス検索欄 */
    .search-input {
        flex: 1;
        width: 320px;
        padding: 10px;
        border: none;
        background-color: whitesmoke;
        box-sizing: border-box;
    }

    /* 性別の選択欄 */
    .search-gender {
        width: 100px;
        padding: 10px;
        border: none;
        background-color: whitesmoke;
        box-sizing: border-box;
    }

    /* お問い合わせ種類の選択欄 */
    .search-category {
        width: 230px;
        padding: 10px;
        border: none;
        background-color: whitesmoke;
        box-sizing: border-box;
    }

    /* 日付検索欄 */
    .search-date {
        width: 150px;
        padding: 10px;
        border: none;
        background-color: whitesmoke;
        box-sizing: border-box;
    }

    /* 検索ボタン */
    .search-button {
        width: 80px;
        padding: 10px;
        border: none;
        background-color: saddlebrown;
        color: white;
        white-space: nowrap;
        cursor: pointer;
    }

    /* リセットボタン */
    .reset-button {
        width: 100px;
        padding: 10px;
        background-color: tan;
        color: white;
        text-align: center;
        text-decoration: none;
        box-sizing: border-box;
        white-space: nowrap;
    }

</style>

<h2>Admin</h2>

<div class="admin">
    <div class="search-form">
        <form class="search-form" action="{{ route('admin.search') }}" method="get">
            <input class="search-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

            <select class="search-gender" name="gender">
                <option value="">性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select class="search-category" name="categry_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('categry_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input class="search-date" type="date" name="date" value="{{ request('date') }}">

            <button class="search-button" type="submit">検索</button>

            <a class="reset-button" href="{{ route('admin.reset') }}">リセット</a>
        </form>
    </div>
    <div class="admin-table-top">
        <div class="export-area">
            <a class="export-button" href="{{ route('admin.export', request()->query()) }}">エクスポート</a>
        </div>

        <div class="pagination">
            {{ $contacts->links() }}
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>
                        {{ $contact->last_name }} {{ $contact->first_name }}
                    </td>
                    <td>
                        @if ($contact->gender == 1)
                            男性
                        @elseif ($contact->gender == 2)
                            女性
                        @else
                            その他
                        @endif
                    </td>
                    <td>
                        {{ $contact->email }}
                    </td>
                    <td>
                        {{ $contact->category->content }}
                    </td>
                    <td>
                        <label class="detail-button" for="modal-{{ $contact->id }}">詳細</label>

                        <input class="modal-checkbox" type="checkbox" id="modal-{{ $contact->id }}">

                        <div class="modal">
                            <label class="modal-background" for="modal-{{ $contact->id }}"></label>

                                <div class="modal-content">
                                    <label class="modal-close" for="modal-{{ $contact->id }}">×</label>

                                    <div class="modal-row">
                                        <div class="modal-label">お名前</div>
                                        <div class="modal-text">
                                            {{ $contact->last_name }} {{ $contact->first_name }}
                                        </div>
                                    </div>

                                    <div class="modal-row">
                                        <div class="modal-label">性別</div>
                                        <div class="modal-text">
                                            @if ($contact->gender == 1)
                                                男性
                                            @elseif ($contact->gender == 2)
                                                女性
                                            @else
                                                その他
                                            @endif
                                        </div>
                                    </div>

                                    <div class="modal-row">
                                        <div class="modal-label">メールアドレス</div>
                                        <div class="modal-text">
                                            {{ $contact->email }}
                                        </div>
                                    </div>

                                    <div class="modal-row">
                                        <div class="modal-label">電話番号</div>
                                        <div class="modal-text">
                                            {{ $contact->tel }}
                                        </div>
                                    </div>

                                    <div class="modal-row">
                                        <div class="modal-label">住所</div>
                                        <div class="modal-text">
                                            {{ $contact->address }}
                                        </div>
                                    </div>

                                    <div class="modal-row">
                                        <div class="modal-label">建物名</div>
                                        <div class="modal-text">
                                            {{ $contact->building }}
                                        </div>
                                    </div>

                                    <div class="modal-row">
                                        <div class="modal-label">お問い合わせの種類</div>
                                        <div class="modal-text">
                                            {{ $contact->category->content }}
                                        </div>
                                    </div>

                                    <div class="modal-row">
                                        <div class="modal-label">お問い合わせ内容</div>
                                        <div class="modal-text">
                                            {{ $contact->detail }}
                                        </div>
                                    </div>

                                    <div class="delete-button-area">
                                        <form action="{{ route('admin.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $contact->id }}">
                                            <button class="delete-button" type="submit">削除</button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection