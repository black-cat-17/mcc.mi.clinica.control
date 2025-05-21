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
        <a href="{{ route('admin.usuarios.nuevo') }}" class="btn btn-secondary">Agregar Nuevo Usuario</a>
    </div>

    {{-- Tabla responsive --}}
    <div class="table-responsive">

        <table class="table align-middle table-bordered table-hover">
            <thead class="text-center table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Tipo Usuario</th>
                    <th>Fecha Alta</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Si no hay usuarios, mostrar mensaje --}}
                @if ($usuarios->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No hay usuarios que mostrar</td>
                    </tr>
                @else
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->ID_user }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ ucfirst($usuario->tipo_user) }}</td>
                            <td class="text-center">{{ $usuario->fecha_alta->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <span>
                                    {{ $usuario->activo == 1 ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="gap-2 d-flex justify-content-center">
                                    <a href="{{ route('admin.usuarios.edit', $usuario->ID_user) }}"
                                        class="btn btn-sm btn-secondary">
                                        Editar
                                    </a>
                                    <form action="{{ route('admin.usuarios.destroy', $usuario->ID_user) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
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
        {{ $usuarios->links('pagination::bootstrap-5') }}
    </div>

</div>
