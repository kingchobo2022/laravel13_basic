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

        <!-- 2. 새 댓글 작성 폼 -->
        <div style="background-color: #f8fafc; padding: 20px; border-radius: 8px;">
            <h4 style="margin-top: 0; margin-bottom: 15px; color: #334155;">댓글 쓰기</h4>

            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf

                <!-- 작성자 입력란 -->
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; margin-bottom: 4px; color: #475569;">작성자</label>
                    <input type="text" 
                        name="author" 
                        value="{{ old('author') }}" 
                        placeholder="닉네임"
                        style="width: 200px; padding: 6px 8px; border: 1px solid {{ $errors->has('author') ? '#ef4444' : '#cbd5e1' }}; border-radius: 4px;">
                    @error('author')
                        <span style="color: #ef4444; font-size: 12px; margin-left: 8px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- 댓글 내용 입력란 -->
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-size: 13px; font-weight: bold; margin-bottom: 4px; color: #475569;">내용</label>
                    <textarea name="content" 
                            rows="3" 
                            placeholder="따뜻한 댓글을 남겨주세요."
                            style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid {{ $errors->has('content') ? '#ef4444' : '#cbd5e1' }}; border-radius: 4px;">{{ old('content') }}</textarea>
                    @error('content')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn" style="background-color: #2563eb;">
                    댓글 등록
                </button>
            </form>
        </div>  
        
        <!-- 작성일 아래 태그 목록 출력 -->
<div style="margin: 10px 0;">
    @foreach ($post->tags as $tag)
        <span style="display: inline-block; background-color: #f1f5f9; color: #475569; font-size: 12px; padding: 3px 8px; border-radius: 9999px; margin-right: 4px;">
            #{{ $tag->name }}
        </span>
    @endforeach
</div>

    </div>


</x-layout>


