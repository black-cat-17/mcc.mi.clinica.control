@extends('mcc.admin.layout') <!-- Asegúrate de usar el layout correcto según el tipo de usuario -->

@section('title', 'Editar Autorizado')

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
                        <h4 class="mb-0">Editar Autorizado</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.autorizados.update', $autorizado->ID_autorizado) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Nombre del paciente --}}
                            <div class="mb-3">
                                <label for="ID_user" class="form-label">Paciente</label>
                                <select name="ID_user" id="ID_user" class="form-control">
                                    <option value="">Selecciona un paciente</option>
                                    @foreach ($pacientes as $paciente)
                                        <option value="{{ $paciente->ID_user }}"
                                            @if ($autorizado->ID_user == $paciente->ID_user) selected @endif>
                                            {{ $paciente->nombre }} {{ $paciente->apellidos }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Nombre del facultativo --}}
                                <div class="mb-3">
                                    <label for="ID_facultativo" class="form-label">Facultativo</label>
                                    <select name="ID_facultativo" id="ID_facultativo" class="form-control">
                                        <option value="">Selecciona un facultativo</option>
                                        @foreach ($facultativos as $facultativo)
                                            <option value="{{ $facultativo->ID_facultativo }}"
                                                {{ old('ID_facultativo', $autorizado->ID_facultativo) == $facultativo->ID_facultativo ? 'selected' : '' }}>
                                                {{ $facultativo->user->nombre }} {{ $facultativo->user->apellidos }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Fecha de alta --}}
                                <div class="mb-3">
                                    <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                                    <input type="date" name="fecha_alta" class="form-control"
                                        value="{{ $autorizado->fecha_alta ? $autorizado->fecha_alta->format('Y-m-d') : '' }}">
                                </div>

                                {{-- Activo --}}
                                <div class="mb-3">
                                    <label for="activo" class="form-label">Activo</label>
                                    <select name="activo" class="form-select" required>
                                        <option value="1" {{ $autorizado->activo == 1 ? 'selected' : '' }}>Sí</option>
                                        <option value="0" {{ $autorizado->activo == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>

                                {{-- Botones --}}
                                <div class="mb-3 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-secondary">Actualizar Autorizado</button>
                                    <a href="{{ route('admin.autorizados') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
