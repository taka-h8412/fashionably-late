<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

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
        }

        /* ヘッダー中央のタイトル */
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: normal;
            font-family: serif;
        }

        /* ヘッダー右側のリンクボタンとログアウトボタン */
        .header a,
        .header-button {
            padding: 6px 18px;
            border: 1px solid tan;
            color: tan;
            background-color: snow;
            font-size: 16px;
            font-family: inherit;
            line-height: normal;
            text-decoration: none;
            cursor: pointer;
        }

        /* ヘッダー右側のリンクボタン */
        .header a {
            position: absolute;
            top: 22px;
            right: 40px;
        }

        /* ログアウトフォームをヘッダー右側に配置する */
        .logout-form {
            position: absolute;
            top: 22px;
            right: 40px;
        }

        /* 各画面のメインコンテンツ幅と中央寄せ */
        .content {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* 各画面の見出し */
        .content h2 {
            margin-bottom: 40px;
            text-align: center;
            font-size: 30px;
            font-weight: normal;
            font-family: serif;
        }

        /* 共通ボタン */
        .button {
            padding: 10px 40px;
            border: none;
            background-color: saddlebrown;
            color: white;
            cursor: pointer;
        }

        /* エラーメッセージ */
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>FashionablyLate</h1>

        {{-- ログインしていて、管理画面の場合のみlogout表示 --}}
        @auth
            @if (request()->routeIs('admin.*'))
                <form class="logout-form" action="/logout" method="POST">
                    @csrf
                    <button class="header-button" type="submit">logout</button>
                </form>
            @endif
        @endauth

        @yield('header')
    </header>
    <main class="content">
        @yield('content')
    </main>
</body>
</html>