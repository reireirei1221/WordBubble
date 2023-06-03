<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
// use App\Models\Title;
use App\Models\Paper;
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
        $input = $request['paper'];
        $title = $input['title'];
        $author_name = $input['name'];
        $rating = $input['rating'];

        // $title = new Title();
        // $title->name =  $title_name;

        $existingPaper = Paper::where('title', $title)->first();
    
        if ($existingPaper) {
            // データが存在する場合はcountを1インクリメントする
            $existingPaper->rating = $rating;
            $existingPaper->save();
            return redirect('/authors/index');
        } else {
            // データが存在しない場合は保存する  
            $paper = new Paper();
            $paper->title = $title;
            $paper->first_author = $author_name;
            $paper->rating = $rating;
            $paper->save();
        }

        $author = new Author();
        $author->name = $author_name;
        $author->count = $rating;
        $existingAuthor = Author::where('name', $author->name)->first();
        if ($existingAuthor) {
            // データが存在する場合はcountを1インクリメントする
            $existingAuthor->count += $rating;
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

        $title = $decodedData->title;
        $authors = $decodedData->authors;
        $rating = $decodedData->rating;

        $first_author = $authors[0];

        if (count($authors) == 1) {
            $authors = array($first_author);
        } else {
            $last_author = $authors[count($authors) - 1];
            $authors = array($first_author, $last_author);
        }

        $existingPaper = Paper::where('title', $title)->first();
        if ($existingPaper) {
            return redirect('/authors/index');
        } else {
            // データが存在しない場合は保存する  
            $paper = new Paper();
            $paper->title = $title;
            $paper->first_author = $first_author;
            if (count($authors) == 2) {
                $paper->last_author = $last_author;
            } else {
                $paper->last_author = null;
            }
            $paper->rating = $rating;
            $paper->save();
        }

        for ($i = 0; $i < count($authors); $i++) {
            $author_name = $authors[$i];

            $existingAuthor = Author::where('name', $author_name)->first();
            if ($existingAuthor) {
                // データが存在する場合はcountを1インクリメントする
                $existingAuthor->count += $rating;
                $existingAuthor->save();
            } else {
                // データが存在しない場合は保存する  
                $author = new Author();
                $author->name = $author_name;
                $author->count = $rating;
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

        $papers = Paper::all();
        foreach ($papers as $paper) {
            $paper->forceDelete();
        }

        // 削除後の処理（例：リダイレクトなど）
        return redirect('/authors/index');
    }
}
