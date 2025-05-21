<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">

    <div class="container">
        <a class="text-gray-900 navbar-brand title-empresa" href="/admin">
            <h3>MCC</h3>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="/admin">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/usuarios*') ? 'active' : '' }}"
                        href="/admin/usuarios">Usuarios</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/especialidades*') ? 'active' : '' }}"
                        href="/admin/especialidades">Especialidades</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/facultativos*') ? 'active' : '' }}"
                        href="/admin/facultativos">Facultativos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/autorizados*') ? 'active' : '' }}"
                        href="/admin/autorizados">Autorizados</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/documentos*') ? 'active' : '' }}"
                        href="/admin/documentos">Documentos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/enlaces*') ? 'active' : '' }}"
                        href="/admin/enlaces">Enlaces</a>
                </li>

            </ul>

        </div>

        <div class="flex items-center justify-end gap-4 p-2">

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="gap-3 d-flex align-items-center">
                @csrf
                <button type="submit" class="btn btn-secondary fw-semibold">
                    | Cerrar sesión |
                    {{ Auth::user()->tipo_user }}
                </button>
            </form>

        </div>

    </div>

</nav>
