@extends('mcc.admin.layout')

@section('title', 'Inicio')

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
                        <h2 class="text-xl font-semibold">Crear Nuevo Usuario</h2>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.usuarios.store') }}" method="POST">
                            @csrf

                            {{-- Nombre --}}
                            <div class="mb-4">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}"
                                    required>
                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Apellidos --}}
                            <div class="mb-4">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}">
                                @error('apellidos')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Correo --}}
                            <div class="mb-4">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                            {{-- Contraseña --}}
                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Confirmar contraseña --}}
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>


                            {{-- Teléfono --}}
                            <div class="mb-4">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                                @error('telefono')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tipo usuario --}}
                            <div class="mb-4">
                                <label for="tipo_user" class="form-label">Tipo usuario</label>
                                <select name="tipo_user" class="form-control" required>
                                    <option value="admin">Administrador</option>
                                    <option value="paciente">Paciente</option>
                                    <option value="facultativo">Facultativo</option>
                                </select>
                                @error('tipo_user')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Bloqueado --}}
                            <div class="flex items-center mb-4 space-x-2">
                                <input type="checkbox" name="activo" value="1" id="activo" checked
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="activo" class="form-label">Activo</label>
                            </div>

                            {{-- Botones --}}
                            <div class="mb-3 d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary">
                                    Crear Usuario
                                </button>
                                <a href="{{ route('admin.usuarios') }}" class="btn btn-danger">
                                    Cancelar
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
