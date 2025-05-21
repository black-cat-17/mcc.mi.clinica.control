<div class="px-5 mt-4 container-fluid">

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    {{-- Botón para crear una nueva especialidad --}}
    <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('facultativo.especialidades.nuevo') }}" class="btn btn-secondary">Agregar Nueva Especialidad</a>
    </div>

    {{-- Tabla responsive --}}
    <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
            <thead class="text-center table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Especialidad</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Si no hay especialidades, mostrar mensaje --}}
                @if ($especialidades->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">No hay especialidades que mostrar</td>
                    </tr>
                @else
                    @foreach ($especialidades as $especialidad)
                        <tr>
                            <td class="text-center">{{ $especialidad->ID_especialidad }}</td>
                            <td>{{ $especialidad->nombre_especialidad }}</td>
                            <td class="td-limit">{{ $especialidad->descripcion }}</td>
                            <td class="text-center">
                                <div class="gap-2 d-flex justify-content-center">
                                    @php
                                        $usuarioLogueado = Auth::user();
                                    @endphp


                                    <a href="{{ route('facultativo.especialidades.edit', $especialidad->ID_especialidad) }}"
                                        class="btn btn-sm btn-secondary">
                                        Editar
                                    </a>
                                    {{-- <form
                                            action="{{ route('facultativo.especialidades.destroy', $especialidad->ID_especialidad) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar esta especialidad?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Eliminar
                                            </button>
                                        </form> --}}
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
        {{ $especialidades->links('pagination::bootstrap-5') }}
    </div>

</div>
