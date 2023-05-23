<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use App\Models\Title;
use GuzzleHttp\Client;

class AuthorController extends Controller
{
    public function store_author(Request $request)
    {
        $name = $request->input('name');
        $post = new Author();
        $post->name = $name;
        $post->meaning = "";
        $post->count = 1;
        
        // 認証キーが設定されている場合のみ翻訳する
        if (config('services.deepl.auth_key')) {
            $input['meaning'] = $this->translate($input['name']);
        }

         // 更新または追加するデータを指定した条件で取得する
        $existingPost = Post::where('name', $name)->first();

        if ($existingPost) {
            // データが存在する場合はcountを1インクリメントする
            $existingPost->count += 1;
            $existingPost->save();
        } else {
            // データが存在しない場合は保存する  
            $post->save();
        }
        return redirect('/');
    }
}
