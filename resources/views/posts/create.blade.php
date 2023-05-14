<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <name>Blog</name>
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
        <!--<h1>チーム開発会へようこそ！</h1>-->
        <h2>Create</h2>
        <form action="/posts" method="POST">
            @csrf
            <div class='center'>
                <h2>front</h2>
                <input type="text" name="post[name]" value="{{ old('post.name') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('post.name') }}</p>
            </div>
            <div class='center'>
                <h2>Back</h2>
                <textarea name="post[meaning]">{{ old('post.meaning') }}</textarea>
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
        <div><a href="/">Return</a></div>
        
    </body>
</html>
