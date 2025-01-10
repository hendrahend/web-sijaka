<!-- filepath: /c:/Users/asus/Documents/VSCode Project/test-laravel-app/resources/views/bookings/calendar.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: [
            @foreach ($approvedBookings as $booking)
            {
              title: '{{ $booking->car->name }} - {{ $booking->car->nopol }}',
              start: '{{ $booking->tanggal_pinjam }}',
              // end: '{{ $booking->selesai_pinjam }}',
            },
            @endforeach
          ]
        });
        calendar.render();
      });
    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>