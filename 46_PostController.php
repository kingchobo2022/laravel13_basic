<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(PostRequest $request)
    {
        $validated = $request->validated();

        // 가장 추천하는 라라벨 관례
        // $request->user()->posts()->create(...)
        // user_id를 개발자가 명시하지 않아도 현재 유저의 ID가 자동으로 채워집니다.
        $post = $request->user()->posts()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => $request->user()->name,
            'is_published' => true,
        ]);

        // Auth 파사드 활용
        // $post = Post::create([
        //     'user_id' => Auth::id(),
        //     'title' => $validated['title'],
        //     'content' => $validated['content'],
        //     'author' => Auth::user()->name,
        //     'is_published' => true,
        // ]);

        if ($request->has('tags')) {
            $post->tags()->attach($request->input('tags'));
        }


        return redirect()
            ->route('posts.index')
            ->with('success', '새 게시글이 성공적으로 등록되었습니다.');

    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');

        return view('posts.search', compact('keyword'));
    }

    public function index(Request $request)
    {
        // $posts = Post::all();
        //$query = Post::where('is_published', true)->latest();
        $query = Post::where('is_published', true)
                ->with(['user', 'tags'])
                ->withCount('comments')
                ->latest();

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('title', 'like', "%{$keyword}%");
        }

        //$posts = $query->get();
        $posts = $query->paginate(10)->withQueryString();

        return view('posts.index', compact('posts'));

    }

    public function show(int $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show1', compact('post'));
    }

    public function edit(int $id)
    {
        $post = Post::findOrFail($id);


        $this->authorize('update', $post);


        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
    }

    public function update(PostRequest $request, int $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $post->update($request->validated());

        $post->tags()->sync($request->input('tags', []));

        return redirect()
            ->route('posts.show', $post->id)
            ->with('success', '게시글이 성공적으로 수정되었습니다.');
    } 

    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', '게시글이 성공적으로 삭제되었습니다.');
    }


}
