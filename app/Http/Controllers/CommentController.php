<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller {

    /****************************************************
     * コメントの追加機能
     *
     * @param object $request 新規コメントのデータ
     * @param object $post コメントされた投稿のデータ
     ****************************************************/
    public function store(Request $request, Post $post) {

        $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();

        return redirect()
            ->route('posts.show', $post);
    }

    /****************************************************
     * コメントの削除機能
     *
     * @param object $comment コメントのデータ
     ****************************************************/
    public function destroy(Comment $comment) {
        
        $comment->status = 0;
        $comment->save();

        return redirect()
            ->route('posts.show', $comment->post);
    }
}
