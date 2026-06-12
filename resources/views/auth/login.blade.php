<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <style>
        /* ページ全体の余白をなくし、基本の文字色を茶色にする */
        body {
            margin: 0;
            color: brown;
        }

        /* ヘッダー全体の余白・下線・中央寄せを設定する */
        .header {
            padding: 20px 40px;
            border-bottom: 1px solid gainsboro;
            text-align: center;
            position: relative;
            background-color: white;
        }

        /* ヘッダー中央のタイトル */
        .header-title {
            margin: 0;
            font-size: 32px;
            font-weight: normal;
            font-family: serif;
        }

        /* ヘッダー右側のリンクボタン */
        .header-link {
            position: absolute;
            top: 22px;
            right: 40px;
            padding: 6px 18px;
            border: 1px solid tan;
            color: tan;
            background-color: snow;
            text-decoration: none;
        }

        /* 認証画面全体の背景色と余白 */
        .auth {
            min-height: calc(100vh - 81px);
            padding: 40px 20px;
            background-color: oldlace;
            box-sizing: border-box;
        }

        /* 認証画面のタイトル */
        .auth-title {
            margin-bottom: 40px;
            text-align: center;
            font-size: 30px;
            font-weight: normal;
            font-family: serif;
        }

        /* ログインフォームの白い枠 */
        .auth-card {
            width: 520px;
            margin: 0 auto;
            padding: 60px 90px;
            background-color: white;
            border: 1px solid gainsboro;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* 入力項目のまとまり */
        .form-group {
            margin-bottom: 35px;
        }

        /* 入力項目のラベル */
        .form-label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        /* 入力欄 */
        .form-input {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: whitesmoke;
            box-sizing: border-box;
        }

        /* エラーメッセージ */
        .form-error {
            margin-top: 5px;
            color: red;
            font-size: 13px;
        }

        /* ボタンエリア */
        .form-button {
            margin-top: 45px;
            text-align: center;
        }

        /* ログインボタン */
        .submit-button {
            padding: 10px 35px;
            border: none;
            background-color: saddlebrown;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1 class="header-title">FashionablyLate</h1>
        <a class="header-link" href="/register">register</a>
    </header>

    <main class="auth">
        <h2 class="auth-title">Login</h2>

        <form class="auth-card" action="/login" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">メールアドレス</label>
                {{-- ブラウザ側の検証ではなくLaravel側のバリデーションを実行するため、typeをemailからtextへ変更 --}}
                <input class="form-input" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">

                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">パスワード</label>
                <input class="form-input" type="password" name="password" id="password" placeholder="例: coachtech1106">

                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-button">
                <button class="submit-button" type="submit">ログイン</button>
            </div>
        </form>
    </main>
</body>
</html>