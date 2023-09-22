@extends('layouts.app')


@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">

            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('perfiles/' . $user->imagen) }}" alt="Usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 items-center md:justify-center md:items-center py-10">

                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl  ">{{ auth()->user()->username }}</p>

                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                </svg>

                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                  {{$user->followers->count()}}
                    <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers->count() )</span>

                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followings->count()}}
                    <span class="font-normal">Seguiendo</span>


                <p class="text-gray-800 text-sm mb-3 font-bold">
                </p>
                {{ $user->count() }}
                <span class="font-normal">Posts</span>
                </p>
                @auth
                    @if ($user->id !== auth()->user()->id)
                    
                        @if (!$user->siguiendo( auth()->user() ) )
                            <form action="{{ route('users.follow', $user) }}" method="post">
                                @csrf
                                <input type="submit" value="SEGUIR"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" />


                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="DEJAR DE SEGUIR"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" />


                            </form>
                        @endif
                    @endif
                @endauth

            </div>

        </div>
    </div>

    <div class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10"> Publicaciones</h2>


        <x-listar-post :posts='$posts' />

      
    </div>

@endsection