<x-layout title="글 수정 하기">
    <h1>글 수정하기</h1>

    @if ($errors->any())
      <div>
          입력값에 오류가 있습니다. 아래 안내를 확인해 주세요.
      </div>
    @endif


    <div class="max-w-xl mx-auto p-6 bg-white rounded-2xl shadow-sm border border-slate-200">
  <form class="space-y-6" action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- 제목 입력창 -->
    <div class="space-y-2">
      <label for="title" class="block text-sm font-semibold text-slate-700">
        제목
      </label>
      <input
        type="text"
        id="title"
        name="title"
        placeholder="제목을 입력하세요"
        value="{{ old('title', $post->title) }}"
        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 transition duration-150 ease-in-out focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
      />
      @error('title')
        <p style="color:#e4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
      @enderror      
    </div>

    <!-- 내용 입력창 -->
    <div class="space-y-2">
      <label for="content" class="block text-sm font-semibold text-slate-700">
        내용
      </label>
      <textarea
        id="content"
        name="content"
        rows="5"
        placeholder="내용을 자세히 작성해 주세요"
        class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 transition duration-150 ease-in-out resize-y focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
      >{{ old('content', $post->content) }}</textarea>

      @error('content')
        <p style="color:#e4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
      @enderror      
    </div>

    <div class="mb-5">
      <label class="block font-bold mb-2">태그 선택</label>
      <div class="flex flex-wrap gap-3">
        @foreach ($tags as $tag)
          <label class="inline-flex items-center text-sm cursor-pointer">
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
              {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray() )) ? 'checked' : '' }}
              class="mr-1.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
            > #{{ $tag->name }}
          </label>
        @endforeach
      </div>
    </div>



    <!-- 저장 버튼 영역 -->
    <div class="flex justify-end pt-2 gap-2">
      <button
        type="submit"
        class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 active:scale-[0.98] transition-all duration-150"
      >
        수정완료
      </button>

      <a href="{{ route('posts.index') }}" class="btn">목록으로</a>
    </div>
  </form>
</div>    

</x-layout>
