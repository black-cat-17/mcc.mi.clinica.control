@extends('mcc.paciente.layout')

@section('title', 'Nuevo Enlace')

@section('content')

    {{-- Mensaje de error de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3 card">
                <div class="card-header">
                    <h4 class="mb-0">Agregar Nuevo Enlace</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('paciente.enlaces.store') }}" method="POST">
                        @csrf

                        {{-- Campo oculto con el ID del usuario autenticado --}}
                        <input type="hidden" name="ID_user" value="{{ Auth::id() }}">


                        {{-- Nombre del Enlace --}}
                        <div class="mb-3">
                            <label for="nombre_url" class="form-label">Nombre del Enlace</label>
                            <input type="text" name="nombre_url" class="form-control" value="{{ old('nombre_url') }}">
                        </div>

                        {{-- Ruta del Enlace --}}
                        <div class="mb-3">
                            <label for="ruta_enlace" class="form-label">URL</label>
                            <input type="url" name="ruta_enlace" class="form-control" value="{{ old('ruta_enlace') }}"
                                required>
                        </div>

                        {{-- Observaciones --}}
                        <div class="mb-3">
                            <label for="observacion_url" class="form-label">Observación</label>
                            <textarea name="observacion_url" class="form-control" rows="3">{{ old('observacion_url') }}</textarea>
                        </div>

                        {{-- Fecha de Alta --}}
                        <div class="mb-3">
                            <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                            <input type="date" name="fecha_alta" class="form-control"
                                value="{{ old('fecha_alta', now()->toDateString()) }}" required>
                        </div>

                        {{-- Botones --}}
                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-secondary">Guardar Enlace</button>
                            <a href="{{ route('paciente.enlaces') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
