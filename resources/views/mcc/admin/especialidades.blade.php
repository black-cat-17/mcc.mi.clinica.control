@extends('mcc.admin.layout')

@section('title', 'Especialidades')

@section('content')

    <div class="text-center">

        <h2> MCC - Mi clínica control</h2>

        <h3>Bienvenido, {{ Auth::user()->nombre }} </h3> {{-- Usuario Logueado --}}

        <p>Listado de Especialidades</p>

    </div>

    {{-- Incluimos la vista --}}
    @include('mcc.admin.listaEspecialidades')

@endsection
