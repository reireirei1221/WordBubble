<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
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
            <h1>Details</h1>
            <div>
                <p>Word：{{ $post->name }}</p>
                <p>Translation：{{ $post->meaning }}</p>
                <p>Definition：{{ $post->definition }}</p>
                <p>Part of speech：{{ $post->part_of_speech }}</p>
        
            </div>
                <!--<p class="edit">[<a href="/posts/{{ $post->id }}/edit">Edit</a>]</p>-->
        </div>
           
    </body>
</html>
