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
    public function index(Author $author)
    {
        return view('authors.index')->with(['authors' => $author->getPaginateByLimit()]);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $input = $request['author'];
        $title_name = $input['title'];
        $author_name = $input['name'];

        $title = new Title();
        $title->name =  $title_name;

        $existingTitle = Title::where('name', $title_name)->first();
        if ($existingTitle) {
            // データが存在する場合はcountを1インクリメントする
            return redirect('/authors/index');
        } else {
            // データが存在しない場合は保存する  
            $title->save();
        }

        $author = new Author();
        $author->name = $author_name;
        $author->count = 1;
        $existingAuthor = Author::where('name', $author->name)->first();
        if ($existingAuthor) {
            // データが存在する場合はcountを1インクリメントする
            $existingAuthor->count += 1;
            $existingAuthor->save();
        } else {
            // データが存在しない場合は保存する  
            $author->save();
        }
        return redirect('/authors/index');
    }

    public function store_from_outside(Request $request)
    {
        // $title_name = $request->input('title');
        // $authors = $request->input("authors");

        $data = $request->query('data');
        $decodedData = json_decode($data);

        $title_name = $decodedData->title;
        $authors = $decodedData->authors;

        $first_author = $authors[0];

        if (count($authors) == 1) {
            $authors = array($first_author);
        } else {
            $last_author = $authors[count($authors) - 1];
            $authors = array($first_author, $last_author);
        }

        $existingTitle = Title::where('name', $title_name)->first();
        if ($existingTitle) {
            return redirect('/authors/index');
        } else {
            // データが存在しない場合は保存する  
            $title = new Title();
            $title->name = $title_name;
            $title->save();
        }

        for ($i = 0; $i < count($authors); $i++) {
            $author_name = $authors[$i];

            $existingAuthor = Author::where('name', $author_name)->first();
            if ($existingAuthor) {
                // データが存在する場合はcountを1インクリメントする
                $existingAuthor->count += 1;
                $existingAuthor->save();
            } else {
                // データが存在しない場合は保存する  
                $author = new Author();
                $author->name = $author_name;
                $author->count = 1;
                $author->save();
            }
        }

        return redirect('/authors/index');
    }

    public function delete_all()
    {
        // authorモデルを使用して全てのauthorデータを取得
        $authors = Author::all();
        foreach ($authors as $author) {
            $author->forceDelete();
        }

        $titles = Title::all();
        foreach ($titles as $title) {
            $title->forceDelete();
        }

        // 削除後の処理（例：リダイレクトなど）
        return redirect('/authors/index');
    }
}
