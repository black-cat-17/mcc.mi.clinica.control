@extends('mcc.admin.layout')

@section('title', 'Editar Especialidad')

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
                        <h4 class="mb-0">Editar Especialidad</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.especialidades.update', $especialidad->ID_especialidad) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Nombre de la Especialidad --}}
                            <div class="mb-3">
                                <label for="nombre_especialidad" class="form-label">Nombre de la Especialidad</label>
                                <input type="text" name="nombre_especialidad" class="form-control"
                                    value="{{ $especialidad->nombre_especialidad }}" required>
                            </div>

                            {{-- Descripción --}}
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3">{{ $especialidad->descripcion }}</textarea>
                            </div>

                            {{-- Botones --}}
                            <div class="mb-3 d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary">Actualizar Especialidad</button>
                                <a href="{{ route('admin.especialidades') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
