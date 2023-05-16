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
                <a href='/posts/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/posts/deleteAll'>
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
        <form action="/posts" method="POST">
            @csrf
            <div class='center'>
                <h2>front</h2>
                <input type="text" name="post[name]" placeholder="単語を入力してください" value="{{ old('post.name') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('post.name') }}</p>
            </div>
            <div class='center'>
                <h2>Back</h2>
                <textarea name="post[meaning]" placeholder="単語の意味を入力してください">{{ old('post.meaning') }}</textarea>
                <p class="meaning__error" style="color:red">{{ $errors->first('post.meaning') }}</p>
            </div>
            <div>
                <!-- <h2>カテゴリー</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select> -->
                <input type="hidden" name="post[count]" value='1'/>
            </div>
            <input type="submit" value="Save"/>
        </form>
        </div>
   
        
    </body>
</html>
