<!-- resources/views/posts/show.blade.php -->
<div class="card" id="comments" style="margin-top: 25px;">
    <h3>댓글 ({{ $post->comments->count() }}개)</h3>

    <!-- 1. 기존 댓글 목록 -->
    <div style="margin-bottom: 25px;">
        @forelse ($post->comments as $comment)
            <div style="padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
                <div style="display: flex; justify-content: space-between; font-size: 13px; color: #64748b;">
                    <strong style="color: #334155;">{{ $comment->author }}</strong>
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p style="margin: 6px 0 0 0; color: #1e293b; line-height: 1.5;">
                    {!! nl2br(e($comment->content)) !!}
                </p>
            </div>
        @empty
            <p style="color: #94a3b8; font-size: 14px; padding: 15px 0;">
                작성된 댓글이 없습니다. 첫 번째 댓글을 남겨보세요!
            </p>
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
</div>
