@extends('mcc.facultativo.layout')

@section('title', 'Enlaces')

@section('content')


    <div class="text-center">

        <h2> MCC - Mi clínica control</h2>

        <h3>Bienvenido, {{ Auth::user()->nombre }} </h3> {{-- Usuario Logueado --}}

        <p>Listado de Enlaces</p>

    </div>


    {{-- Incluimos la vista --}}
    @include('mcc.facultativo.listaEnlaces')

@endsection
