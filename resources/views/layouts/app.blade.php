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
    <div class="">
            <a href="/"><img src="/imgs/abe_img.png" alt="afoo!"/></a>
        
        <ul class="app_ul">

            <li class="app_li"><a href="{{route('members.index')}}">会員管理</a></li>

            <li class="app_li"><a href="{{route('books.index')}}">資料管理</a></li>

            <li class="app_li"><a href="{{route('lendings.index')}}">貸出一覧</a></li>
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