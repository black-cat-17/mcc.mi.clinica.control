<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">
        <a class="text-gray-900 navbar-brand title-empresa" href="/facultativo">
            <h2>MCC</h2>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('facultativo*') ? 'active' : '' }}"
                        href="/facultativo">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('facultativo/perfil*') ? 'active' : '' }}"
                        href="/facultativo/perfil">Perfil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('facultativo/facultativos*') ? 'active' : '' }}"
                        href="/facultativo/facultativos">Facultativo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('facultativo/especialidades*') ? 'active' : '' }}"
                        href="/facultativo/especialidades">Especialidades</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('facultativo/autorizados*') ? 'active' : '' }}"
                        href="/facultativo/autorizados">Autorizados</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('facultativo/documentos*') ? 'active' : '' }}"
                        href="/facultativo/documentos">Documentos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('facultativo/enlaces*') ? 'active' : '' }}"
                        href="/facultativo/enlaces">Enlaces</a>
                </li>

            </ul>

        </div>

        <div class="flex items-center justify-end gap-4 p-2">

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="gap-3 d-flex align-items-center">
                @csrf
                <button type="submit" class="btn btn-primary fw-semibold">
                    | Cerrar sesión |
                    {{ Auth::user()->tipo_user }}
                </button>
            </form>

        </div>

    </div>

</nav>
