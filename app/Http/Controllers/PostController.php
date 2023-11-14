<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller{

    /****************************************************
     * 掲示板トップ画面の表示
     * 
     ****************************************************/
    public function index() {

        $posts = Post::where('status', '=', 1)->latest()->get();
        
        return view('index')
            ->with(['posts' => $posts]);
    }

    /****************************************************
     * 記事詳細画面の表示
     *
     * @param string $post 投稿のID
     ****************************************************/
    public function show($post) {

        $posts = Post::where('status', '=', 1)->find($post);
        if(is_null($posts)){
            abort(404);
        }

        return view('posts.show')
            ->with(['post' => $posts]);
    }

    /****************************************************
     * 記事追加画面の表示
     *
     ****************************************************/
    public function create() {

        return view('posts.create');
    }

    /****************************************************
     * 記事投稿の処理
     *
     * @param object $request 新規投稿のデータ
     ****************************************************/
    public function store(PostRequest $request) { 

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()
            ->route('posts.index');
    }

    /****************************************************
     * 記事編集画面の表示
     *
     * @param object $post 投稿のデータ
     ****************************************************/
    public function edit(Post $post){

        return view('posts.edit')
            ->with(['post' => $post]);
    }

    /****************************************************
     * 記事の更新処理
     *
     * @param object $request 投稿の編集データ
     * @param object $post 投稿のデータ
     ****************************************************/
    public function update(PostRequest $request, Post $post){

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()
            ->route('posts.show', $post);
    }

    /****************************************************
     * 記事の削除処理
     *
     * @param object $post 投稿のデータ
     ****************************************************/
    public function destroy(Post $post){

        $post->status = 0;
        $post->save();

        return redirect()
            ->route('posts.index');
    }

    /****************************************************
     * 記事検索の処理
     *
     * @param object $request 検索キーワード
     ****************************************************/
    public function search(Request $request){

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $post_search_result = Post::where(function ($query) use ($keyword){
                $query->where('title', 'LIKE', "%${keyword}%")
                    ->orwhere('body', 'LIKE', "%${keyword}%");
                })->where('status', '=', 1)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('posts.search_result')
                ->with([
                    'post_search_result' => $post_search_result,
                    'keyword' => $keyword,
                ]);

        }else{
            return redirect()
                ->route('posts.index');
        }
    }
}
