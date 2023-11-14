<x-layout>
    <x-slot name="title">
        {{ $post->title }} - My BBS
    </x-slot>

    <h1>
        <span>{{ $post->title }}</span>
        <a href="{{ route('posts.edit', $post) }}" class="link_edit fa-regular fa-pen-to-square"></a>
        <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete_post">
            @method('PATCH')
            @csrf

            <button class="fa-solid fa-trash btn"></button>
        </form>
    </h1>
    <p class="post_body">{!! nl2br(e($post->body)) !!}</p>
    <h2>Comments</h2>
    <div>
        <form method="post" action="{{ route('comments.store', $post) }}" class="comment-form">
            @csrf
            <input type="text" name="body">
            <button class="add_button">Add</button>
        </form>
    </div>
    @foreach ($post->comments()->where('status', '=', 1)->get() as $comment)
        <div class="comment_item">
            <div><p class="comment_created">post_time：{{ $comment->created_at }}</p></div>
            <div>{{ $comment->body }}</div>
            <div class="comments_destroy">
                <form method="post" action="{{ route('comments.destroy', $comment) }}" class="delete-comment">
                    @method('PATCH')
                    @csrf

                    <button class="fa-solid fa-xmark comments_destroy_button"></button>
                </form>
            </div>
        </div>
    @endforeach

    <script>
        // 投稿の削除
        document.getElementById('delete_post').addEventListener('submit', e => {
            e.preventDefault();

            if (!confirm('投稿を削除してもよろしいですか？')) {
                return;
            }
            e.target.submit();
        });

        // コメントの削除
        document.querySelectorAll('.delete-comment').forEach(form => {
                form.addEventListener('submit', e => {
                    e.preventDefault();

                    if (!confirm('コメントを削除してもよろしいですか？')) {
                        return;
                    }

                    form.submit();
                });
        });
    </script>
</x-layout>