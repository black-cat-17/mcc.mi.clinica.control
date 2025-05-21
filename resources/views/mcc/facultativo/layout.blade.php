<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'MCC')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FullCalendar CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.css" rel="stylesheet">

    <!-- FullCalendar JS (global) desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>

    <!-- CSS personalizado -->
    {{-- <link rel="stylesheet" href="{{ asset('css/custom/custom.css') }}"> --}}
    @vite('public/css/custom/custom.css')
</head>

<body class="d-flex flex-column min-vh-100">

    @include('mcc.facultativo.menu') {{-- Aquí se incluye el menú --}}

    <main class="container mt-4">
        @yield('content') {{-- Aquí se inyecta el contenido de cada página --}}
    </main>

    @include('mcc.components.footer') {{-- Aquí se incluye el footer --}}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Scripts adicionales empujados desde otras vistas -->
    @stack('scripts')


    <script>
        setTimeout(function() {
            const alert = document.getElementById('alert-success');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                alert.style.display = 'none';
            }
        }, 4000); // Se oculta después de 4 segundos
    </script>

</body>

</html>
