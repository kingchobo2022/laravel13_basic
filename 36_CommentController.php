<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // 1. 부모 게시글 조회
        $post = Post::findOrFail($postId);

        // 2. 유효성 검사
        $validated = $request->validate([
            'author' => 'required|max:50',
            'content'=> 'required|min:2|max:1000',
        ], [
            'author.required' => '작성자 이름을 입력해 주세요.',
            'content.required' => '댓글 내용을 입력해 주세요.',
            'content.min' => '댓글 최소 :min자 이상이어야 합니다.',
        ]);

        // 3. 관계(hasMany)를 통한 연관 데이터 저장
        // post_id를 수동으로 넣지 않아도 라라벨이 자동으로 $post->id를 채워줍니다.
        $post->comments()->create($validated);

        // 4. 원래 보던 상세 페이지로 복귀 
        return redirect()
            ->route('posts.show', $post->id)
            ->with('success', '댓글이 성공적으로 등록되었습니다.');
    }
}
