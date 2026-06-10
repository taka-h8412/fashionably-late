<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <style>
        /* ページ全体の余白をなくし、文字色を茶色にする */
        body {
            margin: 0;
            color: brown;
        }

        /* ヘッダー全体 */
        .header {
            height: 60px;
            border-bottom: 1px solid gainsboro;
            position: relative;
        }

        /* ヘッダー中央のタイトル */
        .header-title {
            text-align: center;
            font-size: 28px;
            font-family: serif;
            padding-top: 15px;
        }

        /* ヘッダー右側のリンク */
        .header-link {
            position: absolute;
            top: 20px;
            right: 60px;
            padding: 3px 20px;
            border: 1px solid gainsboro;
            color: tan;
            text-decoration: none;
            background-color: whitesmoke;
        }

        /* ログイン画面全体 */
        .auth {
            background-color: oldlace;
            min-height: 700px;
            padding-top: 40px;
        }

        /* 画面タイトル */
        .auth-title {
            text-align: center;
            font-size: 26px;
            font-family: serif;
            margin-bottom: 35px;
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

        /* エラーメッセージ(赤字) */
        .form-error {
            margin-top: 5px;
            color: red;
            font-size: 13px;
        }

        /* ボタンエリア */
        .form-button {
            text-align: center;
            margin-top: 45px;
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
        <div class="header-title">FashionablyLate</div>
        <a class="header-link" href="/register">register</a>
    </header>

    <main class="auth">
        <h1 class="auth-title">Login</h1>

        <form class="auth-card" action="/login" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">メールアドレス</label>
                <input class="form-input" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">

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