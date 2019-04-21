<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品管理アプリ</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <header>
        <h1>@yield('title', '') </h1>
    </header>
    @yield('content')
</div>
</body>
</html>