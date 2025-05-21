@extends('mcc.paciente.layout')

@section('title', 'Autorizados')

@section('content')

    <div class="text-center">

        <h2> MCC - Mi clínica control</h2>

        <h3>Bienvenido, {{ Auth::user()->nombre }} </h3> {{-- Usuario Logueado --}}

        <p>Listado de Autorizados</p>

    </div>


    {{-- Incluimos la vista --}}
    @include('mcc.paciente.listaAutorizados')

@endsection
