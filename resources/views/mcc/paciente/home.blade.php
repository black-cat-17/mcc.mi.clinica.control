@extends('mcc.paciente.layout')

@section('title', 'Inicio')

@section('content')

    <div class="text-center">

        <h2> MCC - Mi clínica control</h2>

        <h3>Bienvenido, {{ Auth::user()->nombre }} </h3> {{-- Usuario Logueado --}}

    </div>

    {{-- Aquí insertamos el calendario --}}

    @include('mcc.components.calendario')

@endsection
