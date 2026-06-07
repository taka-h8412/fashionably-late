<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <style>
        body {
            margin: 0;
            color: brown;
        }

        .header {
            padding: 20px 40px;
            border-bottom: 1px solid gainsboro;
            text-align: center;
            position: relative;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: normal;
            font-family: serif;
        }

        .header a {
            position: absolute;
            top: 22px;
            right: 40px;
            padding: 6px 18px;
            border: 1px solid tan;
            color: tan;
            background-color: snow;
            text-decoration: none;
        }

        .content {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .content h2 {
            margin-bottom: 40px;
            text-align: center;
            font-size: 30px;
            font-weight: normal;
            font-family: serif;
        }

        .button {
            padding: 10px 40px;
            border: none;
            background-color: saddlebrown;
            color: white;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>FashionablyLate</h1>
        @yield('header')
    </header>

    <main class="content">
        @yield('content')
    </main>
</body>
</html>