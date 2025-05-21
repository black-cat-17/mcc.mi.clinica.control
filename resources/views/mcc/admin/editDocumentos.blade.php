@extends('mcc.admin.layout')

@section('title', 'Editar Documento')

@section('content')

    <div class="container mt-4">

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        {{-- Mensajes de error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3 card">
                    <div class="card-header">
                        <h4 class="mb-0">Editar Documento</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.documentos.update', $documento->ID_documento) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- ID Usuario --}}
                            <div class="mb-3">
                                <label for="ID_user" class="form-label">ID Usuario</label>
                                <input type="text" name="ID_user" class="form-control" value="{{ $documento->ID_user }}"
                                    readonly>
                            </div>

                            {{-- Observación --}}
                            <div class="mb-3">
                                <label for="observacion" class="form-label">Observación</label>
                                <input type="text" name="observacion" class="form-control"
                                    value="{{ old('observacion', $documento->observacion) }}">
                            </div>

                            {{-- Fecha de Alta --}}
                            <div class="mb-3">
                                <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                                <input type="date" name="fecha_alta" class="form-control"
                                    value="{{ old('fecha_alta', $documento->fecha_alta->toDateString()) }}">
                            </div>

                            {{-- Archivo Actual --}}
                            <div class="mb-3">
                                <label class="form-label">Archivo Actual</label><br>
                                @if ($documento->archivo_url && $documento->archivo_url !== 'sin_archivo')
                                    <a href="{{ asset('storage/' . $documento->archivo_url) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        Ver archivo actual
                                    </a>
                                @else
                                    <span class="text-muted">Sin archivo</span>
                                @endif
                            </div>

                            {{-- Subir nuevo archivo --}}
                            <div class="mb-3">
                                <label for="archivo_url" class="form-label">Reemplazar archivo</label>
                                <input type="file" name="archivo_url" class="form-control"
                                    accept=".pdf,.jpg,.jpeg,.png,.docx,.txt">
                            </div>

                            {{-- Botones --}}
                            <div class="mb-3 d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary">Actualizar Documento</button>
                                <a href="{{ route('admin.documentos') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
