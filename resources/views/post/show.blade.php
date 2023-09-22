@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('upload') . '/' . $post->imagen }}" alt="imgagen del post {{ $post->titulo }}">

            <div class="p-3 flex items-center gap-1">
              
                @auth
                  <livewire:like-post :post="$post" />
                @endauth
              
              

            </div>

            <div>
                <p class="font-bold"> {{ $post->user->username }}</p>
              <p class="text-sm text-gray-500"> {{$post->created_at->diffForHumans() }} </p>
              <p class="p-5">{{$post->descripcion}}</p>
            </div>
            @auth
                @if($post->user_id === auth()->user()->id)
                    
                <form method="post"  action="{{route('post.destroy', $post)}}">
                    @method('DELETE')
                    @csrf
                    <input type="submit" 
                    value="Eliminar publicacion"
                    class="bg-red-500 hover:bh-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer ">
                </form>
                @endif
            @endauth

        </div>
        <div class="md:w-1/2 p-5">
          <div class="shadow  bg-white p-5 mb-5">

              @auth
              <p class="text-xl font-bold text-center mb-4"> Agregar un nuevo comentario</p>
              
              @if(session('mensaje'))
                <div class="bg-green-500 p-2 rounded mb-6 text-white text-center uppercase font-bold">
                    {{session('mensaje')}}
                </div>
              @endif

              <form action="{{route('comentarios.store', ['post' => $post, 'user' => $user])}}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Comentario
                    </label>
                    <textarea id="descripcion" name="comentario"
                     placeholder="Agrega comentario"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 outline-red-600 @enderror"
                        />{{ old('descripcion') }}</textarea
                    @error('comentario')
                        <p class="bg-red-500 text-white my-3 rounded-lg text-sm  p-3 text-center">El comentario es obligatorio</p>
                    @enderror
                </div>
          
                <input type="submit" value="Comentar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
          
          
              </form>
            @endauth
            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10 ">
            @if( $post->comentarios->count() )
                @foreach ($post->comentarios as $comentario )
                    <div class="p-5" border-gray-300 border-b>
                        <a href="{{route('post.index',$comentario->user)}}" class="font-bold">{{$comentario->user->username}}</a>
                        <p>{{$comentario->comentario}}</p>
                        <p class="text-sm">{{$comentario->created_at->diffForHumans()}}</p>

                    </div>
                @endforeach
            @endif
            

            </div>
            </div>
       
       
            </div>

    </div>
@endsection
