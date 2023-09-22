@extends("layouts.app")

@section('titulo')
  Titulo
@endsection


@section('contenido')
<x-listar-post :posts='$posts' />

@endsection
