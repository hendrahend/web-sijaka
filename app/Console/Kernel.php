<?php

namespace App\Console;

use App\Models\Booking;
use App\Models\History;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // protected function schedule(Schedule $schedule): void
    // {
    //     // $schedule->command('inspire')->hourly();
    // }

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $completedBookings = Booking::where('status', 'approved')
                ->where('selesai_pinjam', '<', Carbon::now()->toDateString())
                ->get();

            foreach ($completedBookings as $booking) {
                History::create([
                    'name' => $booking->name,
                    'nip' => $booking->nip,
                    'tanggal_pinjam' => $booking->tanggal_pinjam,
                    'selesai_pinjam' => $booking->selesai_pinjam,
                    'car_id' => $booking->car_id,
                    'sopir_id' => $booking->sopir_id,
                    'kegiatan' => $booking->kegiatan,
                    'catatan' => $booking->catatan,
                ]);

                // Update the status of the car to 'available'
                $car = $booking->car;
                $car->status = 'available';
                $car->save();

                // Update the status of the sopir to 'available' if a sopir is associated
                if ($booking->sopir_id) {
                    $sopir = $booking->sopir;
                    $sopir->status = 'available';
                    $sopir->save();
                }

                // Delete the booking
                $booking->delete();
            }
        })->daily();
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
