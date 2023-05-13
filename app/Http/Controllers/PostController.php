<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

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
        //dd($post->count);
        $data = [
            'count' => $post->count + 1, // 更新または追加するデータ
            // 他のデータも追加する場合は、連想配列に追加する
        ];
        
        //$post = Post::updateOrCreate(['name' => $input['name']], $data);
         // 更新または追加するデータを指定した条件で取得する
        $existingPost = Post::where('name', $input['name'])->first();

        if ($existingPost) {
            // データが存在する場合はcountを1インクリメントする
            $existingPost->count += 1;
            
        } else {
            // データが存在しない場合は保存する  
            $post->fill($input)->save();

        }

        return redirect('/posts/' . $post->id);
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

}
