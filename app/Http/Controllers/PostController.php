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
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(), 'part_of_speech' => 'all']);
    }

    public function filter_by_part_of_speech(Post $post, $part_of_speech)
    {
        if ($part_of_speech == 'all') {
            return view('posts.index')->with(['posts' => $post->getPaginateByLimit(), 'part_of_speech' => 'all']);
        }
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(), 'part_of_speech' => $part_of_speech]);
    }

    public function show(Post $word)
    {
        $post = Post::where('name', strtolower($word))->first();
        return view('posts.show')->with(['post' => $post]);
    }

    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
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
        $input['name'] = strtolower($input['name']);

        // 認証キーが設定されている場合のみ翻訳する
        // if (config('services.deepl.auth_key')) {
        //     $input['meaning'] = $this->translate_with_deepl($input['name']);
        // }

        // if (config('services.openai.auth_key')) {
        //     $input['meaning'] = $this->translate_with_openai($input['name']);
        //     $word_data_array = $this->get_word_data_with_openai($input['name']);
        //     $input['definition'] = $word_data_array[0];
        //     $input['part_of_speech'] = $word_data_array[1];
        // }

         // 更新または追加するデータを指定した条件で取得する
        $existingPost = Post::where('name', $input['name'])->first();

        if ($existingPost) {
            // データが存在する場合はcountを1インクリメントする
            $existingPost->count += 1;
            $existingPost->save();
            # return redirect('/posts/' . $existingPost->id);
            return redirect('/words/index');
        } else {
            // データが存在しない場合は保存する  
            $post->fill($input)->save();
            # return redirect('/posts/' . $post->id);
            return redirect('/words/index');
        }
    }

    public function store_from_outside(Request $request)
    {
        $name = $request->query('word');
        $part_of_speech = $request->query('partOfSpeech');

        $post = new Post();
        $post->name = $name;
        $post->part_of_speech = $part_of_speech;
        // $post->part_of_speech = "";
        $post->count = 1;
        
        // 認証キーが設定されている場合のみ翻訳する
        if (config('services.deepl.auth_key')) {
            $input['meaning'] = $this->translate_with_deepl($input['name']);
        }

        if (config('services.openai.auth_key')) {
            $input['meaning'] = $this->translate_with_openai($input['name']);
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
        return redirect('/words/index');
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }

    // Put method
    public function update(Request $request, Post $post)
    {
        $input_post = $request['post'];
        // dd($post['count']);
        $post->fill($input_post)->save();

        return redirect('/words/' . $post->id);
    }
    
    public function delete_all()
    {
        // Postモデルを使用して全てのpostデータを取得
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->forceDelete();
        }

        // 削除後の処理（例：リダイレクトなど）
        return redirect('/words/index');
    }

    // 翻訳結果を出力する
    public function translate_with_deepl(String $text)
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

    public function translate_with_openai(String $word)
    {
        // ChatGPTのエンドポイント
        $apiendpoint = 'https://api.openai.com/v1/completions';

        // APIキー
        $apikey = config('services.openai.auth_key');

        // HTTPクライアントのインスタンスを生成
        $client = new Client();

        try {
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apikey,
            );
            
            $data = array(
                'prompt' => '次の単語を和訳して: ' . $word,
                'model' => 'text-davinci-002',
                'max_tokens' => 50,
            );
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiendpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            $response = curl_exec($ch);
            curl_close($ch);

            // // ChatGPTのAPIにリクエストを送信
            // $response = $client->post($apiEndpoint, [
            //     'headers' => [
            //         'Authorization' => 'Bearer ' . $apiKey,
            //         'Content-Type' => 'application/json',
            //     ],
            //     'json' => [
            //         'prompt' => 'Translate the word: ' . $word,
            //         'max_tokens' => 50,
            //     ],
            // ]);
            // dd($response);
            // APIレスポンスから和訳を取得
            $translation = json_decode($response, true)['choices'][0]['text'];

            // 和訳を返す
            // return response()->json(['translation' => $translation]);
            return $translation;

        } catch (\Exception $e) {
            // エラーが発生した場合はエラーメッセージを返す
            // return response()->json(['error' => 'Translation request failed.']);
            return 'Translation request failed.';
        }
    }

    public function get_word_data_with_openai(String $word) {
                // ChatGPTのエンドポイント
        $apiendpoint = 'https://api.openai.com/v1/completions';

        // APIキー
        $apikey = config('services.openai.auth_key');

        // HTTPクライアントのインスタンスを生成
        $client = new Client();

        try {
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apikey,
            );
            
            $data = array(
                'prompt' => 'Provide the definition and the part of speech of the following word in JSON format: ' . $word,
                'model' => 'text-davinci-002',
                'max_tokens' => 50,
                'temperature' => 1,
            );
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiendpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
            $response = curl_exec($ch);
            curl_close($ch);

            // dd($response);

            // // ChatGPTのAPIにリクエストを送信
            // $response = $client->post($apiEndpoint, [
            //     'headers' => [
            //         'Authorization' => 'Bearer ' . $apiKey,
            //         'Content-Type' => 'application/json',
            //     ],
            //     'json' => [
            //         'prompt' => 'Translate the word: ' . $word,
            //         'max_tokens' => 50,
            //     ],
            // ]);
            // dd($response);
            // APIレスポンスから和訳を取得
            $definition = json_decode($response, true)['choices'][0]['definition'];
            $part_of_speech = json_decode($response, true)['choices'][0]['part_of_speech'];

            // 和訳を返す
            // return response()->json(['translation' => $translation]);
            return array($definition, $part_of_speech);

        } catch (\Exception $e) {
            // エラーが発生した場合はエラーメッセージを返す
            // return response()->json(['error' => 'Translation request failed.']);
            return 'Translation request failed.';
        }
    }
}
