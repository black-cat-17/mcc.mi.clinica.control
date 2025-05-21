<div class="px-5 mt-4 container-fluid">

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
                <div class="text-center card-header">
                    <h4 class="mb-0">USUARIO</h4>
                </div>

                <div class="card-body">
                    @if (!$user)
                        <div class="text-center alert alert-warning">
                            No se puede mostrar el usuario.
                        </div>
                    @else
                        {{-- Datos del usuario --}}
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="ID_user" class="form-label">ID</label>
                                <input type="text" name="ID_user" class="form-control" value="{{ $user->ID_user }}"
                                    readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="tipo_user" class="form-label">Tipo de Usuario</label>
                                <input type="text" class="form-control" value="{{ ucfirst($user->tipo_user) }}"
                                    readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" value="{{ $user->nombre }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" value="{{ $user->apellidos }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" value="{{ $user->telefono }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                                <input type="text" class="form-control"
                                    value="{{ $user->fecha_alta->format('d-m-Y') }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="activo" class="form-label">Activo</label>
                                <input type="text" class="form-control"
                                    value="{{ $user->activo == 1 ? 'Sí' : 'No' }}" readonly>
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="mb-3 d-flex justify-content-between">
                            <a href="{{ route('paciente.perfil.edit', $user->ID_user) }}"
                                class="btn btn-secondary">Editar</a>
                            {{-- <form action="{{ route('paciente.perfil.destroy', $user->ID_user) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button> --}}
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
