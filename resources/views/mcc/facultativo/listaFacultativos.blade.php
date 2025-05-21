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
        <a href="{{ route('facultativo.facultativos.nuevo') }}" class="btn btn-secondary">Agregar Nuevo Facultativo</a>
    </div>


    {{-- Tabla responsive --}}
    <div class="table-responsive">

        <table class="table align-middle table-bordered table-hover">
            <thead class="text-center table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Si no hay facultativos, mostrar mensaje --}}
                @if ($facultativos->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No hay facultativos que mostrar</td>
                    </tr>
                @else
                    @foreach ($facultativos as $facultativo)
                        <tr>
                            <td class="text-center">{{ $facultativo->ID_facultativo }}</td>
                            @php
                                $usuario = $usuarios->firstWhere('ID_user', $facultativo->ID_user);
                            @endphp

                            <td>{{ $usuario ? $usuario->nombre : 'Sin usuario' }}
                                {{ $usuario ? $usuario->apellidos : 'Sin usuario' }}</td>
                            @php
                                $especialidade = $especialidades->firstWhere(
                                    'ID_especialidad',
                                    $facultativo->ID_especialidad,
                                );
                            @endphp

                            <td>{{ $especialidade ? $especialidade->nombre_especialidad : 'Sin especialidad' }}</td>
                            <td class="text-center">
                                <div class="gap-2 d-flex justify-content-center">
                                    @php
                                        $usuarioLogueado = Auth::user();
                                    @endphp

                                    @if ($facultativo->ID_user == $usuarioLogueado->ID_user)
                                        <a href="{{ route('facultativo.facultativos.edit', $facultativo->ID_facultativo) }}"
                                            class="btn btn-sm btn-secondary">
                                            Editar
                                        </a>
                                    @endif
                                    {{-- <form
                                        action="{{ route('facultativo.facultativos.destroy', $facultativo->ID_facultativo) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este facultativo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    </form>  --}}
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
        {{ $facultativos->links('pagination::bootstrap-5') }}
    </div>
</div>
