@extends('mcc.admin.layout')

@section('title', 'Usuario')

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
                        <h4 class="mb-0">Editar Usuario</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.usuarios.update', $usuario->ID_user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Nombre --}}
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}"
                                    required>
                            </div>

                            {{-- Apellidos --}}
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control"
                                    value="{{ $usuario->apellidos }}">
                            </div>

                            {{-- Teléfono --}}
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" value="{{ $usuario->telefono }}">
                            </div>

                            {{-- Correo Electrónico --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" value="{{ $usuario->email }}"
                                    required>
                            </div>

                            {{-- Nueva Contraseña --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" name="password" class="form-control">
                                <small class="form-text text-muted">Dejar en blanco si no desea cambiarla.</small>
                            </div>

                            {{-- Confirmar Contraseña --}}
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation" required>
                                <small class="form-text text-muted">Por favor, confirme su nueva contraseña.</small>
                            </div>

                            {{-- Tipo usuario --}}
                            <div class="mb-3">
                                <label for="tipo_user" class="form-label">Tipo usuario</label>
                                <select name="tipo_user" class="form-select">
                                    <option value="paciente" {{ $usuario->tipo_user == 'paciente' ? 'selected' : '' }}>
                                        Paciente</option>
                                    <option value="facultativo"
                                        {{ $usuario->tipo_user == 'facultativo' ? 'selected' : '' }}>Facultativo</option>
                                    <option value="admin" {{ $usuario->tipo_user == 'admin' ? 'selected' : '' }}>
                                        Administrador</option>
                                </select>
                            </div>

                            {{-- Activo --}}
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="activo" value="1" class="form-check-input" id="activo"
                                    {{ $usuario->activo ? 'checked' : '' }}>
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>

                            {{-- Botones --}}
                            <div class="mb-3 d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary">Actualizar Usuario</button>
                                <a href="{{ route('admin.usuarios') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
