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
        <a href="{{ route('paciente.autorizados.nuevo') }}" class="btn btn-secondary">Agregar Nuevo Autorizado</a>
    </div>


    {{-- Tabla responsive --}}
    <div class="table-responsive">

        <table class="table align-middle table-bordered table-hover">
            <thead class="text-center table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Facultativo</th>
                    <th>Fecha Alta</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Si no hay autorizados, mostrar mensaje --}}
                @if ($autorizadosPaciente->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No hay autorizados que mostrar</td>
                    </tr>
                @else
                    @foreach ($autorizadosPaciente as $autorizado)
                        <tr>
                            <td>{{ $autorizado->ID_autorizado }}</td>
                            <td>{{ $autorizado->paciente->nombre }} {{ $autorizado->paciente->apellidos }}</td>
                            <td>{{ $autorizado->ID_facultativo }}</td>
                            <td>{{ $autorizado->fecha_alta }}</td>
                            <td>{{ $autorizado->activo }}</td>
                            <td class="text-center">
                                <div class="gap-2 d-flex justify-content-center">
                                    <a href="{{ route('paciente.autorizados.edit', $autorizado->ID_autorizado) }}"
                                        class="btn btn-sm btn-secondary">
                                        Editar
                                    </a>
                                    <form
                                        action="{{ route('paciente.autorizados.destroy', $autorizado->ID_autorizado) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este autorizado?');">
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
        {{ $autorizadosPaciente->links('pagination::bootstrap-5') }}
    </div>

</div>
