@extends('mcc.facultativo.layout')

@section('title', 'Editar Facultativo')

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
                        <h4 class="mb-0">Editar Facultativo</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('facultativo.facultativos.update', $facultativo->ID_facultativo) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            {{-- ID_facultativo --}}
                            <div class="mb-3">
                                <label for="ID_facultativo" class="form-label">Facultativo</label>
                                <input type="text" name="ID_facultativo" class="form-control"
                                    value="{{ $facultativo->ID_facultativo }}" readonly>
                            </div>

                            {{-- ID_user --}}
                            <div class="mb-3">
                                <label for="ID_user" class="form-label">Usuario</label>
                                <select name="ID_user" class="form-select" required>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->ID_user }}"
                                            {{ $facultativo->ID_user == $usuario->ID_user ? 'selected' : '' }}>
                                            {{ $usuario->nombre }} {{ $usuario->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- ID_especialidad --}}
                            <div class="mb-3">
                                <label for="ID_especialidad" class="form-label">Especialidad</label>
                                <select name="ID_especialidad" class="form-select" required>
                                    @foreach ($especialidades as $especialidad)
                                        <option value="{{ $especialidad->ID_especialidad }}"
                                            {{ $facultativo->ID_especialidad == $especialidad->ID_especialidad ? 'selected' : '' }}>
                                            {{ $especialidad->nombre_especialidad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Botones --}}
                            <div class="mb-3 d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary">Actualizar Facultativo</button>
                                <a href="{{ route('facultativo.facultativos') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
