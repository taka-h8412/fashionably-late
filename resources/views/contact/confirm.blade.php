@extends('layouts.app')

@section('title', 'Confirm')

@section('content')
<style>
    /* 確認画面全体の幅と中央寄せ */
    .confirm {
        width: 760px;
        margin: 0 auto;
    }

    /* 項目名と内容を横並びにする */
    .confirm-group {
        display: flex;
    }

    /* 左側の項目名 */
    .confirm-label {
        width: 220px;
        padding: 15px;
        border: 1px solid gainsboro;
        background-color: saddlebrown;
        color: white;
        box-sizing: border-box;
    }

    /* 右側の入力内容 */
    .confirm-content {
        width: 540px;
        padding: 15px;
        border: 1px solid gainsboro;
        box-sizing: border-box;
    }

    /* ボタンを中央寄せ */
    .confirm-button {
        margin-top: 30px;
        text-align: center;
    }

    .back-button {
        margin-left: 20px;
        border: none;
        background: none;
        color: brown;
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<h2>Confirm</h2>

<form class="confirm" action="{{ route('contact.store') }}" method="post">
    @csrf

    <div class="confirm-group">
        <div class="confirm-label">お名前</div>
        <div class="confirm-content">
            {{ $contact['last_name'] }} {{ $contact['first_name'] }}
        </div>
    </div>

    <div class="confirm-group">
        <div class="confirm-label">性別</div>
        <div class="confirm-content">
            @if ($contact['gender'] == 1)
                男性
            @elseif ($contact['gender'] == 2)
                女性
            @else
                その他
            @endif
        </div>
    </div>

    <div class="confirm-group">
        <div class="confirm-label">メールアドレス</div>
        <div class="confirm-content">
            {{ $contact['email'] }}
        </div>
    </div>

    <div class="confirm-group">
        <div class="confirm-label">電話番号</div>
        <div class="confirm-content">
            {{ $contact['tel'] }}
        </div>
    </div>

    <div class="confirm-group">
        <div class="confirm-label">住所</div>
        <div class="confirm-content">
            {{ $contact['address'] }}
        </div>
    </div>

    <div class="confirm-group">
        <div class="confirm-label">建物名</div>
        <div class="confirm-content">
            {{ $contact['building'] }}
        </div>
    </div>

    <div class="confirm-group">
        <div class="confirm-label">お問い合わせの種類</div>
        <div class="confirm-content">
            {{ $category->content }}
        </div>
    </div>

    <div class="confirm-group">
        <div class="confirm-label">お問い合わせ内容</div>
        <div class="confirm-content">
            {{ $contact['detail'] }}
        </div>
    </div>

    {{-- お問い合わせ確認画面から送信ボタンでDB登録するための保存用のhidden --}}
    <input type="hidden" name="categry_id" value="{{ $contact['categry_id'] }}"> {{-- 仕様書のカラム名 categry_id --}}
    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
    <input type="hidden" name="email" value="{{ $contact['email'] }}">
    <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
    <input type="hidden" name="address" value="{{ $contact['address'] }}">
    <input type="hidden" name="building" value="{{ $contact['building'] }}">
    <input type="hidden" name="detail" value="{{ $contact['detail'] }}">

    <div class="confirm-button">
        <button class="button" type="submit">送信</button>
        <button class="back-button" type="button" onclick="history.back()">修正</button>
    </div>
</form>
@endsection