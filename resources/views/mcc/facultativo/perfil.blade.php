@extends('mcc.facultativo.layout')

@section('title', 'Perfil')

@section('content')

    <div class="text-center">

        <h2> MCC - Mi clínica control</h2>

        <h3>Bienvenido, {{ Auth::user()->nombre }} </h3> {{-- Usuario Logueado --}}

    </div>

    {{-- Incluimos la vista --}}
    @include('mcc.facultativo.listaUsuarios')

@endsection
