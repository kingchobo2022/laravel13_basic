<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

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

        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'author' => '홍길동',
            'is_published' => true,
        ]);

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
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
    }

    public function update(PostRequest $request, int $id)
    {
        $post = Post::findOrFail($id);

        $post->update($request->validated());

        $post->tags()->sync($request->input('tags', []));

        return redirect()
            ->route('posts.show', $post->id)
            ->with('success', '게시글이 성공적으로 수정되었습니다.');
    } 

    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', '게시글이 성공적으로 삭제되었습니다.');
    }


}
