<x-layout>
    <x-slot name="title">
        My BBS
    </x-slot>

    <form action="{{ route('posts.search') }}" method="GET">
        @csrf
        <div class="post_search">
            <input type="text" name="keyword" class="search_text" placeholder="keyword">
            <button class="fa-solid fa-magnifying-glass search_button"></button>
        </div>
    </form>
    <h1>
        <span>Post List</span>
        <a href="{{ route('posts.create') }}" class='link_add'>[Add]</a>
    </h1>
        @forelse ($posts as $post)
        <div class="post_item">
            <a href="{{ route('posts.show', $post) }}">
                {{ $post->title }}
            </a>
            <div>
                <p class="post_time">post_time：{{ $post->created_at }}</p>
            </div>
        </div>
        @empty
            <div>No posts yet!</div>
        @endforelse
</x-layout>