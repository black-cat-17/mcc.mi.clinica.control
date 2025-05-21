<div class="px-5 mt-4 container-fluid">

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    {{-- Botón para crear un nuevo usuario --}}
    <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('admin.enlaces.nuevo') }}" class="btn btn-secondary">Agregar Nuevo Enlace</a>
    </div>

    {{-- Tabla responsive --}}
    <div class="table-responsive">

        <table class="table align-middle table-bordered table-hover">
            <thead class="text-center table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre URL</th>
                    <th>Ruta</th>
                    <th>Observación</th>
                    <th>Fecha Alta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Si no hay enlaces, mostrar mensaje --}}
                @if ($enlaces->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No hay enlaces que mostrar</td>
                    </tr>
                @else
                    @foreach ($enlaces as $enlace)
                        <tr>
                            <td>{{ $enlace->ID_enlace }}</td>
                            @php
                                $usuario = $usuarios->firstWhere('ID_user', $enlace->ID_user);
                            @endphp
                            <td>{{ $usuario ? $usuario->nombre : 'Sin usuario' }}
                                {{ $usuario ? $usuario->apellidos : 'Sin usuario' }}</td>
                            <td>{{ $enlace->nombre_url }}</td>
                            <td class="td-limit"><a href="{{ $enlace->ruta_enlace }}"
                                    target="_blank">{{ $enlace->ruta_enlace }}</a></td>
                            <td class="td-limit">{{ $enlace->observacion_url }}</td>
                            <td class="text-center">{{ $enlace->fecha_alta->format('d-m-Y') }}</td>

                            <td class="text-center">
                                <div class="gap-2 d-flex justify-content-center">
                                    <a href="{{ route('admin.enlaces.edit', $enlace->ID_enlace) }}"
                                        class="btn btn-sm btn-secondary">Editar</a>
                                    <form action="{{ route('admin.enlaces.destroy', $enlace->ID_enlace) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este enlace?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
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
        {{ $enlaces->links('pagination::bootstrap-5') }}
    </div>

</div>
