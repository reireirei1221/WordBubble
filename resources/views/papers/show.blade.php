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
            <h1>Details</h1>
            <div>
                <p>title：{{ $paper->title }}</p>
                <p>url：{{ $paper->url }}</p>
                <p>abstract：{{ $paper->abstract }}</p>
            </div>
                <!--<p class="edit">[<a href="/papers/{{ $paper->id }}/edit">Edit</a>]</p>-->
        </div>
    </body>
</x-app-layout>
</html>
