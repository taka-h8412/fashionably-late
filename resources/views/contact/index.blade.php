@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<style>
    /* フォーム全体の幅と中央寄せ */
    .form {
        width: 760px;
        margin: 0 auto;
    }

    /* ラベルと入力欄を横並びにする */
    .form-group {
        display: flex;
        margin-bottom: 20px;
    }

    /* 左側ラベルの幅を揃える */
    .form-label {
        width: 220px;
        padding-top: 10px;
    }

    /* 右側入力欄の幅を揃える */
    .form-input {
        width: 540px;
    }

    /* 姓・名を横並びにする */
    .name-inputs {
        display: flex;
        gap: 20px;
    }

    /* 電話番号3分割を横並びにする */
    .tel-inputs {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    /* 入力欄の共通デザイン */
    .input {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: whitesmoke;
        box-sizing: border-box;
    }

    /* 姓・名の幅調整 */
    .name-input {
        width: 50%;
    }

    /* 電話番号欄の幅調整 */
    .tel-input {
        width: 30%;
    }

    /* お問い合わせ内容欄の高さ指定 */
    .textarea {
        height: 120px;
    }

    /* 性別欄の位置調整 */
    .radio-group {
        padding-top: 10px;
    }

    /* 性別ラジオボタン同士の間隔 */
    .radio-group label {
        margin-right: 30px;
    }

    /* 確認ボタン中央寄せ */
    .form-button {
        margin-top: 30px;
        text-align: center;
    }
</style>

<h2>Contact</h2>

<form class="form" action="{{ route('contact.confirm') }}" method="post">
    @csrf

    <div class="form-group">
        <label class="form-label">お名前<span style="color: red;">※</span></label>
        <div class="form-input">
            <div class="name-inputs">
                <input class="input name-input" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                <input class="input name-input" type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
            </div>
            @error('last_name')
                <p class="error">{{ $message }}</p>
            @enderror
            @error('first_name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">性別<span style="color: red;">※</span></label>
        <div class="form-input">
            <div class="radio-group">
                <label>
                    <input type="radio" name="gender" value="1"> 男性
                </label>
                <label>
                    <input type="radio" name="gender" value="2"> 女性
                </label>
                <label>
                    <input type="radio" name="gender" value="3"> その他
                </label>
            </div>
            @error('gender')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">メールアドレス<span style="color: red;">※</span></label>
        <div class="form-input">
            <input class="input" type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}"> {{-- T1 ブラウザ側のバリデーションが先に動くため、typeをemailからtextへ変更 --}}
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">電話番号<span style="color: red;">※</span></label>
        <div class="form-input">
            <div class="tel-inputs">
                <input class="input tel-input" type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                <span>-</span>
                <input class="input tel-input" type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                <span>-</span>
                <input class="input tel-input" type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
            </div>
            @error('tel1')
                <p class="error">{{ $message }}</p>
            @enderror
            @error('tel2')
                <p class="error">{{ $message }}</p>
            @enderror
            @error('tel3')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">住所<span style="color: red;">※</span></label>
        <div class="form-input">
            <input class="input" type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
            @error('address')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">建物名</label>
        <div class="form-input">
            <input class="input" type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
            @error('building')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">お問い合わせの種類<span style="color: red;">※</span></label>
        <div class="form-input">
            <select class="input" name="categry_id"> {{-- 仕様書のカラム名 categry_id --}}
                <option value="">選択してください</option> {{-- ヒントテキスト:selectではplaceholderが使えない --}}
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            @error('categry_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">お問い合わせ内容<span style="color: red;">※</span></label>
        <div class="form-input">
            <textarea class="input textarea" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            @error('detail')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-button">
        <button class="button" type="submit">確認画面</button>
    </div>
</form>
@endsection