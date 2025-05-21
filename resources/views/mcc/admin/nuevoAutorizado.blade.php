@extends('mcc.admin.layout')

@section('title', 'Nuevo Autorizado')

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
                    <h4 class="mb-0">Agregar Nuevo Autorizado</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.autorizados.store') }}" method="POST">
                        @csrf

                        {{-- Nombre del Paciente --}}
                        <div class="mb-3">
                            <label for="ID_user" class="form-label">Paciente</label>
                            <select name="ID_user" class="form-control" required>
                                <option value="">Seleccione un paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->ID_user }}">
                                        {{ $paciente->nombre }} {{ $paciente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Nombre del Facultativo --}}
                        <div class="mb-3">
                            <label for="ID_facultativo" class="form-label">Facultativo</label>
                            <select name="ID_facultativo" class="form-control" required>
                                <option value="">Seleccione un facultativo</option>
                                @foreach ($facultativos as $facultativo)
                                    <option value="{{ $facultativo->ID_facultativo }}">
                                        {{ $facultativo->user->nombre }} {{ $facultativo->user->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Fecha de Alta --}}
                        <div class="mb-3">
                            <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                            <input type="date" name="fecha_alta" class="form-control"
                                value="{{ old('fecha_alta', now()->toDateString()) }}" required>
                        </div>

                        {{-- Estado Activo --}}
                        <div class="mb-3">
                            <label for="activo" class="form-label">Activo</label>
                            <select name="activo" class="form-control" required>
                                <option value="1" {{ old('activo') == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('activo') == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        {{-- Botones --}}
                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-secondary">
                                Crear Autorizado
                            </button>
                            <a href="{{ route('admin.autorizados') }}" class="btn btn-danger">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
