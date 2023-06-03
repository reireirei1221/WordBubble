<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/style.css" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <!-- <header>
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
                <a href='/authors/delete-all'>
                    <span class="material-symbols-outlined">delete</span>
                </a>
            </li>
            </ul>
        </nav>
    </header> -->
    <x-app-layout>
                <x-slot name="header">
            <nav>
            <ul>
            <!-- <li class="app-name">WordBubbles</li> -->
            <li><a href="/authors/index">
                <span class="material-symbols-outlined">home</span>
                </a>
            </li>
            <li>
                <a href='/authors/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/authors/delete-all'>
                    <span class="material-symbols-outlined">delete</span>
                </a>
            </li>
            <li>
            </ul>
        </nav>
    </x-slot>
    <body>
        <div class='center'>
        <!--<h1>チーム開発会へようこそ！</h1>-->
        <h1>Create</h1>
        <form action="/authors/store" method="POST">
            @csrf
            <div class='center'>
                <h2>Title</h2>
                <input type="text" name="paper[title]" placeholder="タイトルを入力してください" value="{{ old('paper.title') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('paper.title') }}</p>
            </div>
            <div class='center'>
                <h2>Author</h2>
                <input type="text" name="paper[name]" placeholder="著者名を入力してください" value="{{ old('paper.name') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('paper.name') }}</p>
            </div>
            <div>
                <input type="hidden" name="paper[count]" value='1'/>
            </div>
            <div>
                <h2>Rating</h2>
                <input type="radio" name="paper[rating]" value="1" checked="checked"/>1
                <input type="radio" name="paper[rating]" value="2"/>2
                <input type="radio" name="paper[rating]" value="3"/>3
                <input type="radio" name="paper[rating]" value="4"/>4
                <input type="radio" name="paper[rating]" value="5"/>5
            </div>
            <input type="submit" value="Save"/>
        </form>
        </div>
    </body>
</x-app-layout>
</html>
