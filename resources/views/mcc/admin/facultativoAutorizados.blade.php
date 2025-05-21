@extends('mcc.admin.layout')

@section('title', 'Agregar Facultativo')

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
                    <h4 class="mb-0">Agregar Facultativo</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.facultativoAutorizados') }}" method="POST">
                        @csrf

                        {{-- Seleccionar el paciente --}}
                        <div class="mb-3">
                            <label for="ID_user" class="form-label">Paciente</label>
                            <select name="ID_user" class="form-control">
                                <option value="">Seleccione un Paciente</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Seleccionar la especialidad --}}
                        <div class="mb-3">
                            <label for="ID_especialidad" class="form-label">Especialidad</label>
                            <select name="ID_especialidad" class="form-control">
                                <option value="">Seleccione una Especialidad</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->ID_especialidad }}">{{ $especialidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Botones --}}
                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Guardar Facultativo</button>
                            <a href="{{ route('admin.facultativos') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection