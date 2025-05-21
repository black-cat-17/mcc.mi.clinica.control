@extends('mcc.facultativo.layout')

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
                    <form action="{{ route('admin.facultativos.store') }}" method="POST">
                        @csrf

                        {{-- ID_user --}}
                        <div class="mb-3">
                            <label for="ID_user" class="form-label">Usuario</label>
                            <select name="ID_user" class="form-control" required>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">
                                        {{ $usuario->nombre }} {{ $usuario->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Id_especialidad --}}
                        <div class="mb-3">
                            <label for="Id_especialidad" class="form-label">Especialidad</label>
                            <select name="Id_especialidad" class="form-control" required>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->Id_especialidad }}">
                                        {{ $especialidad->nombre_especialidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Botones --}}
                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-secondary">
                                Crear Facultativo
                            </button>
                            <a href="{{ route('facultativo.facultativos') }}" class="btn btn-danger">
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
