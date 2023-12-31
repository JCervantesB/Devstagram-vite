<div>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        @foreach ($posts as $post)
        <div>
            <a href="{{ route('post.show', ['post' => $post, 'user' => $post->user]) }}"> <img
                src="{{ asset('upload') . '/' . $post->imagen }}" alt="{{ $post->titulo }}"></a>
            </div>
            @endforeach
        </div>
        <div class="my-10">
            {{$posts->links()}}
        </div>
        @else

        <p class="text-center">No hay Posts, sigue a alguien para poder mostrar sus posts</p>

        @endif
</div>
