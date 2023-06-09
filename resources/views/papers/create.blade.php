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
            <li class="app-name">paperBubbles</li>
            <li><a href="/">
                <span class="material-symbols-outlined">home</span>
                </a>
            </li>
            <li>
                <a href='/papers/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/papers/delete-all'>
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
            <!-- <li class="app-name">paperBubbles</li> -->
            <li><a href="/papers/index">
                <span class="material-symbols-outlined">home</span>
                </a>
            </li>
            <li>
                <a href='/papers/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/papers/delete-all'>
                    <span class="material-symbols-outlined">delete</span>
                </a>
            </li>
            <li>
            </ul>
        </nav>
    </x-slot>
    <body>
        <div class='center'>
        <h1>Create</h1>
        <form action="/papers/store" method="post">
            @csrf
            <div class='center'>
                <h2>paper</h2>
                <input type="text" name="paper[title]" placeholder="単語を入力してください" value="{{ old('paper.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('paper.title') }}</p>
            </div>
            <div class='center'>
                <h2>URL</h2>
                <input type="text" name="paper[url]" placeholder="urlを入力してください">{{ old('paper.url') }}</input>
                <p class="url__error" style="color:red">{{ $errors->first('paper.url') }}</p>
            </div>
            <div class='center'>
                <h2>Abstract</h2>
                <textarea name="paper[abstract]" placeholder="概要を入力してください">{{ old('paper.abstract') }}</textarea>
                <p class="abstract__error" style="color:red">{{ $errors->first('paper.abstract') }}</p>
            </div>
            <input type="submit" value="Save"/>
        </form>
        </div>
    </body>
    </x-app-layout>
</html>
