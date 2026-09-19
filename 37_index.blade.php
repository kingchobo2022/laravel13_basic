<x-layout title="게시글 목록">
    <h1>게시판 글 목록</h1>
    <form method="GET" action="{{ route('posts.index') }}">
        검색어: <input type="text" name="keyword">
        <button type="submit">확인</button>
    </form>

    @if (session('success'))
        


<div class="flex items-start gap-4 p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-900 shadow-sm">
  <!-- 아이콘 -->
  <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
  </div>

  <!-- 내용 -->
  <div class="flex-1 text-sm">
    <h4 class="font-semibold text-emerald-950">처리가 완료되었습니다</h4>
    <p class="mt-1 text-emerald-700 leading-relaxed">
      {{ session('success') }}
    </p>
  </div>
</div>        

    @endif


<div class="max-w-3xl mx-auto my-8 bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
  <!-- 테이블 헤더 및 리스트 -->
  <table class="w-full text-left border-collapse">
    <thead>
      <tr class="border-b border-slate-200 bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">
        <th scope="col" class="px-6 py-3.5">제목</th>
        <th scope="col" class="px-6 py-3.5 w-36 text-right sm:text-left">작성자</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-slate-100 text-sm">
       @foreach ($posts as $post) 
      <!-- 게시물 행 1 -->
      <tr class="hover:bg-slate-50 transition duration-150 cursor-pointer">
        <td class="px-6 py-4 font-medium text-slate-800 line-clamp-1">
          <a href="{{ route('posts.show', $post['id']) }}">{{ $post['title'] }}</a>

          @if ($post->comments_count > 0)
              <span style="font-size: 12px; color: #2563eb; font-weight: bold; margin-left: 4px;">
              [{{ $post->comments_count }}]
              </span>    
          @endif

          @if ($post->created_at->isToday())
              <span style="background-color: #fee2e2; color: #dc2626; font-size: 11px; padding: 2px 6px; border-radius: 4px; margin-left: 4px;">NEW</span>  
          @endif


        </td>
        <td class="px-6 py-4 text-slate-500 text-right sm:text-left whitespace-nowrap">
          {{ $post['author'] }}
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>

    <div style="margin: 20px;">
        {{ $posts->links() }}
    </div>


</div>




</x-layout>
