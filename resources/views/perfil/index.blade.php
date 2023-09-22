@extends('layouts.app')

@section('titulo')
    Editar Perfil {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md-w-1/2 bg-white shadow p-6">

            <form action="{{route('perfil.store')}}" enctype="multipart/form-data"  method="POST" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input id="username" name="username" placeholder="Tu username" type="text"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 outline-red-600 @enderror"
                        value="{{ old('username', $username ?? auth()->user()->username) }}" />
                    @error('username')
                        <p class="bg-red-500 text-white my-3 rounded-lg text-sm  p-3 text-center">El username es obligatorio</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de Perfil
                    </label>
                    <input id="imagen"
                        name="imagen"
                        type="file"
                        accept=".jpg, .png, .jpeg"
                        class="border p-3 w-full rounded-lg"
                        value="{{ auth()->user()->username }}" />
              
                </div>


                <input type="submit" value="Guardar cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
       
            </form>

        </div>

    </div>
@endsection
