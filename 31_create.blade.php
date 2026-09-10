<x-layout title="새 글 작성">
    <h1>새 글 쓰기</h1>

    <div class="max-w-xl mx-auto p-6 bg-white rounded-2xl shadow-sm border border-slate-200">
  <form class="space-y-6" action="{{ route('posts.store') }}" method="POST">
    @csrf
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
        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-800 placeholder-slate-400 transition duration-150 ease-in-out focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
      />
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
      ></textarea>
    </div>

    <!-- 저장 버튼 영역 -->
    <div class="flex justify-end pt-2">
      <button
        type="submit"
        class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 active:scale-[0.98] transition-all duration-150"
      >
        저장
      </button>
    </div>
  </form>
</div>    

</x-layout>
