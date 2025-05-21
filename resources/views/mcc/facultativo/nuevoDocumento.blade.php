@extends('mcc.facultativo.layout')

@section('title', 'Nuevo Documento')

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
                    <h4 class="mb-0">Agregar Nuevo Documento</h4>
                </div>

                <div class="card-body">

                    {{-- Formulario --}}
                    <form action="{{ route('facultativo.documentos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Campo visible y de solo lectura con el ID del usuario autenticado --}}
                        <div class="mb-3">
                            <label for="ID_user" class="form-label">ID Usuario</label>
                            <input type="text" class="form-control" name="ID_user" id="ID_user"
                                value="{{ Auth::user()->ID_user }}" readonly>
                        </div>

                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="observacion" class="form-label">Observación</label>
                            <input type="text" class="form-control" name="observacion" id="observacion"
                                value="{{ old('observacion') }}" required>
                        </div>

                        {{-- Fecha de Alta --}}
                        <div class="mb-3">
                            <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                            <input type="date" name="fecha_alta" class="form-control"
                                value="{{ old('fecha_alta', now()->toDateString()) }}" required>
                        </div>

                        {{-- Archivo --}}
                        <div class="mb-3">
                            <label for="archivo_url" class="form-label">Archivo</label>
                            <input type="file" class="form-control" name="archivo_url" id="archivo_url"
                                accept=".txt,.pdf,.jpg,.jpeg,.png,.docx,.xlsx">
                        </div>

                        {{-- Botones --}}
                        <div class="mb-3 d-flex justify-content-between">
                            <button type="submit" class="btn btn-secondary">Guardar Documento</button>
                            <a href="{{ route('facultativo.documentos') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
