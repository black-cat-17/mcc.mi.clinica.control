@extends('mcc.facultativo.layout')

@section('title', 'Nueva Especialidad')

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
                    <h4 class="mb-0">Agregar Nueva Especialidad</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('facultativo.especialidades.store') }}" method="POST">
                        @csrf

                        {{-- Nombre de la Especialidad --}}
                        <div class="mb-3">
                            <label for="nombre_especialidad" class="form-label">Nombre de la Especialidad</label>
                            <input type="text" name="nombre_especialidad" class="form-control"
                                value="{{ old('nombre_especialidad') }}" required>
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        {{-- Botones --}}
                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-secondary">
                                Crear Especialidad
                            </button>
                            <a href="{{ route('facultativo.especialidades') }}" class="btn btn-danger">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
