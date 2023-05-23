<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use GuzzleHttp\Client;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
    }

    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
    }

    public function create(Category $category)
    {
        return view('posts/create')->with(['categories' => $category->get()]);
    }

    // public function store(Post $post, Request $request)
    // {
    //     $input = $request['post'];
    //     $post->fill($input)->save();
    //     return redirect('/posts/' . $post->id);
    // }

    // Post method
    public function store(Post $post, Request $request)
    {
        $input = $request['post'];
        // dd($input);

        // 認証キーが設定されている場合のみ翻訳する
        if (config('services.deepl.auth_key')) {
            $input['meaning'] = $this->translate($input['name']);
        }

         // 更新または追加するデータを指定した条件で取得する
        $existingPost = Post::where('name', $input['name'])->first();

        if ($existingPost) {
            // データが存在する場合はcountを1インクリメントする
            $existingPost->count += 1;
            $existingPost->save();
            # return redirect('/posts/' . $existingPost->id);
            return redirect('/');
        } else {
            // データが存在しない場合は保存する  
            $post->fill($input)->save();
            # return redirect('/posts/' . $post->id);
            return redirect('/');
        }
    }

  
    public function store_word(Request $request)
    {
        $name = $request->query('name');
        $post = new Post();
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
    
    public function store_author(Request $request)
    {
        $name = $request->query('name');
        // dd($name);
        $post = new Post();
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

    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }

    // Put method
    public function update(Request $request, Post $post)
    {
        $input_post = $request['post'];
        // dd($post['count']);
        $post->fill($input_post)->save();

        return redirect('/posts/' . $post->id);
    }
    
    public function delete_all()
    {
        
        // Postモデルを使用して全てのpostデータを取得
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->delete();
        }

        // 削除後の処理（例：リダイレクトなど）
        return redirect('/');
    }

    // 翻訳結果を出力する
    public function translate(String $text)
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api-free.deepl.com/v2/translate', [
            'form_params' => [
                'auth_key' => config('services.deepl.auth_key'),
                'text' => $text,
                'target_lang' => 'JA',
            ]
        ]);

        $response = json_decode($response->getBody(), true);

        //return view('posts/translate')->with(['response' => $response]);
        return $response['translations'][0]['text'];
    }
}
