@extends('mcc.facultativo.layout')

@section('title', 'Facultativo')

@section('content')

    <div class="text-center">

        <h2> MCC - Mi clínica control</h2>

        <h3>Bienvenido, {{ Auth::user()->nombre }} </h3> {{-- Usuario Logueado --}}

        <p>Listado de Facultativos</p>

    </div>

    {{-- Incluimos la vista --}}
    @include('mcc.facultativo.listaFacultativos')

@endsection
