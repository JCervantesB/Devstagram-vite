@extends('layouts.app')

@section('titulo')
    Inicia sesion en Devstagram
@endsection


@section('contenido')
    <div class="md:flex md:justify-center md:gap:10 md:items-center">

        <div class="md:w-5/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen logjn usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow">

            <form method="post" action="{{ route('login') }}" autocomplete="off">
                @csrf

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-3 rounded-lg text-sm  p-3 text-center">{{ session('mensaje') }}</p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" name="email" placeholder="Tu email" type="email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 outline-red-600 @enderror"
                        value="{{ old('email') }}" />
                    @error('email')
                        <p class="bg-red-500 text-white my-3 rounded-lg text-sm  p-3 text-center">El email es obligatorio</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input id="password" name="password" placeholder="Password" type="password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 outline-red-600 @enderror" />

                    @error('password')
                        <p class="bg-red-500 text-white my-3 rounded-lg text-sm  p-3 text-center">El password es obligatorio</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember" >
                    <label for="" class="text-gray-500 text-sm">Mantener mi sesion abierta</label>
                </div>


                <input type="submit" value="Iniciar sesion"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>

    </div>
@endsection
