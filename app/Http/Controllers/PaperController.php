<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;

class PaperController extends Controller
{
    public function index(Paper $paper)
    {
        return view('papers.index')->with(['papers' => $paper->getPaginateByLimit()]);
    }

    public function create()
    {
        return view('papers.create');
    }

    public function store(Request $request, Paper $paper)
    {
        $input = $request['paper'];
        $paper->fill($input)->save();
        return redirect('/papers/index');
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
        $url = $decodedData->url;
        $abstract = $decodedData->abstract;

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
            $paper->url = $url;
            $paper->abstract = $abstract;
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

    public function show(Paper $paper)
    {
        return view('papers.show')->with(['paper' => $paper]);
    }

    public function edit(Paper $paper)
    {
        return view('papers.edit')->with(['paper' => $paper]);
    }

    public function update(Request $request, Paper $paper)
    {
        $input_paper = $request['paper'];
        $paper->fill($input_paper)->save();
        return redirect('/papers/index');
    }

    public function delete_all()
    {
        // Postモデルを使用して全てのpostデータを取得
        $papers = Paper::all();
        foreach ($papers as $paper) {
            $paper->forceDelete();
        }

        // 削除後の処理（例：リダイレクトなど）
        return redirect('/papers/index');
    }
}
