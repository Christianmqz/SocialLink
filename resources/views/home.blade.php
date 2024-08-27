@extends('layouts.app')

@section('titulo')
    Inicio 
@endsection

@section('contenido')
    <!-- x-  Indica que se trata de un componente -->
    <!-- Es necesario pasar la variable para que pueda leerse en el componente -->
    <x-listar-post :posts="$posts" />
@endsection