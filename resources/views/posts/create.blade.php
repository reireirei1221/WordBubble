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
                <a href='/posts/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/posts/delete-all'>
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
            <li><a href="/words/index">
                <span class="material-symbols-outlined">home</span>
                </a>
            </li>
            <li>
                <a href='/words/create'>
                    <span class="material-symbols-outlined">add_circle</span>
                </a>
            </li>
            <li>
                <a href='/words/delete-all'>
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
        <form action="/words/store" method="POST">
            @csrf
            <div class='center'>
                <h2>Word</h2>
                <input type="text" name="post[name]" placeholder="単語を入力してください" value="{{ old('post.name') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('post.name') }}</p>
            </div>
            <div class='center'>
                <h2>Translation</h2>
                <input type="text" name="post[meaning]" placeholder="和訳を入力してください">{{ old('post.meaning') }}</input>
                <p class="meaning__error" style="color:red">{{ $errors->first('post.meaning') }}</p>
            </div>
            <div class='center'>
                <h2>Definition</h2>
                <textarea name="post[definition]" placeholder="定義を入力してください">{{ old('post.definition') }}</textarea>
                <p class="definition__error" style="color:red">{{ $errors->first('post.definition') }}</p>
            </div>
            <div class='part_of_speech'>
                <h2>Part of speech</h2>
                <select name="post[part_of_speech]">
                    <option value="">品詞を選択してください</option>
                    <option value="noun">名詞</option>
                    <option value="verb">動詞</option>
                    <option value="adjective">形容詞</option>
                    <option value="adverb">副詞</option>
                    <option value="preposition">前置詞</option>
                </select>
                <p class="part_of_speech__error" style="color:red">{{ $errors->first('post.part_of_speech') }}</p>
            </div>
            <input type="hidden" name="post[count]" value='1'/>
            <input type="submit" value="Save"/>
        </form>
        </div>
    </body>
    </x-app-layout>
</html>
