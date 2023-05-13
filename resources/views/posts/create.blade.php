<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <name>Blog</name>
    </head>
    <meaning>
        <h1>チーム開発会へようこそ！</h1>
        <h2>投稿作成</h2>
        <form action="/posts" method="POST">
            @csrf
            <div>
                <h2>タイトル</h2>
                <input type="text" name="post[name]" placeholder="タイトル" value="{{ old('post.name') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('post.name') }}</p>
            </div>
            <div>
                <h2>本文</h2>
                <textarea name="post[meaning]" placeholder="今日も1日お疲れさまでした。">{{ old('post.meaning') }}</textarea>
                <p class="meaning__error" style="color:red">{{ $errors->first('post.meaning') }}</p>
            </div>
            <div>
                <!-- <h2>カテゴリー</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select> -->
                <input type="number" name="post[count]" value='1'/>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div><a href="/">戻る</a></div>
    </meaning>
</html>
