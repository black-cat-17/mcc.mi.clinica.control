<nav class="navbar navbar-expand-lg navbar-dark bg-success">

    <div class="container">
        <a class="text-gray-900 navbar-brand title-empresa" href="/paciente">
            <h2>MCC</h2>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('paciente*') ? 'active' : '' }}" href="/paciente">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('paciente/perfil*') ? 'active' : '' }}"
                        href="/paciente/perfil">Perfil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('paciente/autorizados*') ? 'active' : '' }}"
                        href="/paciente/autorizados">Autorizados</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('paciente/documentos*') ? 'active' : '' }}"
                        href="/paciente/documentos">Documentos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('paciente/enlaces*') ? 'active' : '' }}"
                        href="/paciente/enlaces">Enlaces</a>
                </li>

            </ul>

        </div>

        <div class="flex items-center justify-end gap-4 p-2">

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="gap-3 d-flex align-items-center">
                @csrf
                <button type="submit" class="btn btn-success fw-semibold">
                    | Cerrar sesión |
                    {{ Auth::user()->tipo_user }}
                </button>
            </form>

        </div>

    </div>

</nav>
