<x-layout title="{{ $post->title }}">

    @if (session('success'))
        <div class="bg-green-100 border-green-400 text-green-700">
        {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <h1>{{ $post->title }}</h1>

        <p style="color: #64748b;">
            작성자 : {{ $post->author }} |
            조회수 : {{ $post->views }}회 |
            작성일 : {{ $post->created_at->format('Y-m-d H:i') }}
        </p>
        <hr>
        <div style="margin: 20px 0; line-height: 1.6;">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div class="flex gap-2">
            <a href="{{ route('posts.edit', $post->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">수정하기</a>
            <a href="{{ route('posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">목록으로</a>

            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('정말 이 게시글을 삭제하시겠습니까?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">삭제하기</button>
            </form>
        </div>
    </div>

    <div class="card" style="margin-top: 25px;">
        <h3>댓글 ({{ $post->comments->count() }}개)</h3>

        <!-- 댓글 목록 -->
        <div style="margin-bottom: 20px;">
            @forelse ($post->comments as $comment)
                <div style="padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px; color: #64748b;">
                        <strong>{{ $comment->author }}</strong>
                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p style="margin: 6px 0 0 0; color: #1e293b;">
                        {{ $comment->content }}
                    </p>
                </div>
            @empty
                <p style="color: #94a3b8; font-size: 14px;">작성된 댓글이 없습니다. 첫 댓글을 남겨보세요!</p>
            @endforelse
        </div>
    </div>


</x-layout>


