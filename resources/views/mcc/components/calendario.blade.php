<div class="container-fluid">

    <!-- Contenedor del calendario -->
    <div id="calendar" class="p-4 mx-auto my-4 bg-white rounded shadow w-100"></div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                if (!calendarEl) return;

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es',
                    initialView: 'dayGridMonth',
                    buttonText: {
                        today: 'Hoy'
                    }
                });
                calendar.render();
            });
        </script>
    @endpush

</diV>
