@extends('mcc.facultativo.layout')

@section('title', 'Enlace')

@section('content')

    <div class="container mt-4">

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
                        <h4 class="mb-0">Editar Enlace</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('facultativo.enlaces.update', $enlace->ID_enlace) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Nombre URL --}}
                            <div class="mb-3">
                                <label for="nombre_url" class="form-label">Nombre del Enlace</label>
                                <input type="text" name="nombre_url" class="form-control"
                                    value="{{ $enlace->nombre_url }}">
                            </div>

                            {{-- Ruta Enlace --}}
                            <div class="mb-3">
                                <label for="ruta_enlace" class="form-label">URL</label>
                                <input type="url" name="ruta_enlace" class="form-control"
                                    value="{{ $enlace->ruta_enlace }}" required>
                            </div>

                            {{-- Observación --}}
                            <div class="mb-3">
                                <label for="observacion_url" class="form-label">Observación</label>
                                <textarea name="observacion_url" class="form-control" rows="3">{{ $enlace->observacion_url }}</textarea>
                            </div>

                            {{-- Fecha Alta --}}
                            <div class="mb-3">
                                <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                                <input type="date" name="fecha_alta" class="form-control"
                                    value="{{ $enlace->fecha_alta }}">
                            </div>


                            {{-- Botones --}}
                            <div class="mb-3 d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary">Actualizar Enlace</button>
                                <a href="{{ route('facultativo.enlaces') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
