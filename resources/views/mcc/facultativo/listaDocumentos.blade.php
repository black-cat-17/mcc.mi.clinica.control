<div class="px-5 mt-4 container-fluid">

    {{-- Mensaje de éxito o error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    {{-- Botón para crear un nuevo usuario --}}
    <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('facultativo.documentos.nuevo') }}" class="btn btn-secondary">Agregar Nuevo Documento</a>
    </div>

    {{-- Tabla responsive --}}
    <div class="table-responsive">

        <table class="table align-middle table-bordered table-hover">
            <thead class="text-center table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Observación</th>
                    <th>Fecha Alta</th>
                    <th>Archivo</th>
                    <th></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Si no hay enlaces, mostrar mensaje --}}
                @if ($documentos->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No hay documentos que mostrar</td>
                    </tr>
                @else
                    @forelse ($documentos as $documento)
                        <tr>
                            <td>{{ $documento->ID_documento }}</td>
                            @php
                                $usuario = $usuarios->firstWhere('ID_user', $documento->ID_user);
                            @endphp
                            <td>{{ $usuario ? $usuario->nombre : 'Sin usuario' }}
                                {{ $usuario ? $usuario->apellidos : 'Sin usuario' }}</td>
                            <td class="td-limit">{{ $documento->observacion }}</td>
                            <td class="text-center">{{ $documento->fecha_alta->format('d-m-Y') }}</td>
                            <td class="td-limit">{{ $documento->archivo_url }}</td>
                            <td>
                                @if ($documento->archivo_url && $documento->archivo_url !== 'sin_archivo')
                                    <a href="{{ asset('storage/' . $documento->archivo_url) }}" target="_blank">Ver
                                        archivo</a>
                                @else
                                    Sin archivo
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="gap-2 d-flex justify-content-center">
                                    <a href="{{ route('facultativo.documentos.edit', $documento->ID_documento) }}"
                                        class="btn btn-sm btn-secondary">
                                        Editar
                                    </a>
                                    <form
                                        action="{{ route('facultativo.documentos.destroy', $documento->ID_documento) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este docuemnto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    {{-- Paginación si se usa paginate() en el controlador --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $documentos->links('pagination::bootstrap-5') }}
    </div>

</div>
