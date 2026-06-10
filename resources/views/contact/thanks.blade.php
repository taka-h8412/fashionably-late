<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanks</title>

    <style>
        /* ページ全体の余白をなくし、文字色を茶色にする */
        body {
            margin: 0;
            color: brown;
        }

        /* サンクスページ全体を中央寄せにする */
        .thanks {
            position: relative;
            text-align: center;
            margin-top: 250px;
        }

        /* お問い合わせ完了メッセージ */
        .thanks-message {
            font-size: 24px;
            margin-bottom: 40px;
        }

        /* 背景に薄く表示する Thank you の文字 */
        .thanks-background {
            position: absolute;
            top: -100px;
            left: 0;
            right: 0;
            color: whitesmoke;
            font-size: 160px;
            z-index: -1;
            font-family: serif;
        }

        /* HOMEボタン */
        .home-button {
            padding: 10px 40px;
            background-color: saddlebrown;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="thanks">
        <div class="thanks-background">Thank you</div>

        <p class="thanks-message">お問い合わせありがとうございました</p>

        <a class="home-button" href="{{ route('contact.index') }}">HOME</a>
    </div>
</body>
</html>