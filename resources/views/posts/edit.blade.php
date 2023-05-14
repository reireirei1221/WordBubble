<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blog</title>
    </head>
    <nav>
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="#">メニュー2</a></li>
        <li><a href='/posts/create'>Add</a></li>
        </ul>
    </nav>
    <body>
        <h1 class="title">Edit</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__title'>
                    <h2>Front</h2>
                    <input type='text' name='post[title]' value="{{ $post->title }}">
                </div>
                <div class='content__body'>
                    <h2>Back</h2>
                    <input type='text' name='post[body]' value="{{ $post->body }}">
                </div>
                <input type="submit" value="Save">
            </form>
        </div>
    </body>
</html>
