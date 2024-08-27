<div>
    <!-- Components son piezas de código como sections, layouts and includes en Laravel -->

    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', [ 'post' => $post, 'user' => $post->user ]) }}">
                        <img src="{{ asset('/build/uploads') . '/' . $post->imagen }}" alt="Post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{ $posts->links() }}
        </div>
        
    @else
        <p class="text-center">No hay publicaciones que mostrar</p>
    @endif
</div>