<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/style.css" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <header>
        <nav>
            <ul>
            <li class="app-name">WordBubbles</li>
            <li><a href="/">
                <span class="material-symbols-outlined">home</span>
                </a>
            </li>
            <li>
                <a href='/authors/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/authors/deleteAll'>
                    <span class="material-symbols-outlined">delete</span>
                </a>
            </li>
            </ul>
        </nav>
    </header>
    <body>
        <div class='center'>
        <!--<h1>チーム開発会へようこそ！</h1>-->
        <h1>Create</h1>
        <form action="/authors" method="POST">
            @csrf
            <div class='center'>
                <h2>Title</h2>
                <input type="text" name="author[title]" placeholder="タイトルを入力してください" value="{{ old('author.title') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('author.title') }}</p>
            </div>
            <div class='center'>
                <h2>Author</h2>
                <input type="text" name="author[name]" placeholder="著者名を入力してください" value="{{ old('author.name') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('author.name') }}</p>
            </div>
            <div>
                <input type="hidden" name="author[count]" value='1'/>
            </div>
            <input type="submit" value="Save"/>
        </form>
        </div>
    </body>
</html>
