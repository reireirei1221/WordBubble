<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blog</title>
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
        <h1 class="title">Edit</h1>
        <div class="content">
            <form action="/words/{{ $post->id }}" method="POST">
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
    </x-app-layout>
</html>
