<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <name>Posts</name>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/style2.css" >
    </head>
    <nav>
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="#">メニュー2</a></li>
        <li><a href='/posts/create'>Add</a></li>
        </ul>
    </nav>
    <body>
        <div class='center'>
            <h1>Details</h1>
            <div>
                <p>Front：{{ $post->name }}</p>
                <p>Back：{{ $post->meaning }}</p>
        
            </div>
                <p class="edit">[<a href="/posts/{{ $post->id }}/edit">Edit</a>]</p>
        </div>
            <a href="/">Return</a>
    </body>
</html>
