<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <title>afoo</title>
</head>
<header>
    <div class="">
            <a href="/"><img src="/imgs/abe_img.png" /></a>
        
        <ul>
            <li><a href="{{route('members.index')}}">会員管理</a></li>
            <li><a href="">資料管理</a></li>
            <li><a href="{{route('lendings.index')}}">貸出一覧</a></li>
        </ul>
        
    </div>
    <hr>
</header>
<body>
    <main>
    @yield('content')
    </main>
    
</body>
</html>