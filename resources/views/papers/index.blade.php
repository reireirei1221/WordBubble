<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/style.css" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script src="/js/content.js"></script>
    </head>

<x-app-layout>
    <x-slot name="header">
            <nav>
            <ul>
            <!-- <li class="app-name">WordBubbles</li> -->
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
            <!-- <label for="dog-names"></label>  -->
                <select name="part-of-speeches" id="part-of-speeches">
                    <option value="all">All</option>
                    <option value="noun">Noun</option> 
                    <option value="verb">Verb</option>
                    <option value="adjective">Adjective</option>
                    <option value="adverb">Adverb</option>
                    <option value="preposition">Preposition</option>
                </select>
            </li>
            </ul>
        </nav>
    </x-slot>
    <body>
        <h1>Blog Name</h1>
        <div class='papers'>
            @foreach ($papers as $paper)
                <div class='paper'>
                    <h2 class='title'>{{ $paper->title }}</h2>
                </div>
            @endforeach
        </div>
    </body>
</x-app-layout>
</html>