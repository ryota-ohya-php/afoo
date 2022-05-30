<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>afoo</title>
</head>

<header>
    <div class="block">
            <a href="/"><img src="/imgs/abe_img.png" alt="afoo!"/></a>
        <ul class="app_ul">
             {{-- class="app_ul"> --}}
            <li class="app_li">
                <button class="button is-text app_button" onclick="location.href='{{route('members.index')}}'">会員管理</button></li>
            <li class="app_li">
                <button class="button is-text app_button" onclick="location.href='{{route('books.index')}}'">書籍管理</button></li>
            <li class="app_li">
                <button class="button is-text app_button" onclick="location.href='{{route('lendings.index')}}'">貸出一覧</button></li>
        </ul>
    </div>
    <hr>
</header>

<body>
    <main>
    @include('layouts/flash')
    @yield('content')
    </main>
</body>

</html>