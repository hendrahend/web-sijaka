<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
       <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ dayGridPlugin, interactionPlugin ],
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            events: [
                {
                    title: 'Event 1',
                    start: '2025-01-01',
                },
                {
                    title: 'Event 2',
                    start: '2024-11-20',
                    end: '2024-11-22'
                },
                {
                    title: 'Event on 10th',
                    start: '2024-12-10'
                },
                {
                    title: 'Event on 12th',
                    start: '2024-12-12'
                }
            ],
            editable: true,
            droppable: true,  // If you want to drag events
        });
        calendar.render();
    });
</script>

    </script>
</x-app-layout>
