<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Sopir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $bookings = Booking::with(['car', 'sopir'])->get();
        $approvedBookings = Booking::where('status', 'approved')->get();
        $bookingss = Booking::where('status', 'pending')->count();
        $cars = Car::all();
        $carss = Car::where('status', 'available')->count();
        $carsss = Car::where('status', 'unavailable')->count();
        $sopirs = Sopir::where('status', 'available')->count();
        return view('dashboard', compact('bookings', 'cars', 'sopirs', 'bookingss', 'carss', 'carsss', 'approvedBookings'));
    }


// Group data by day, week, or month based on user selection
public function getBookingStats(Request $request)
{
    $period = $request->input('period', 'month'); // Default is 'month'

    $approvedBookings = Booking::where('status', 'approved');

    if ($period === 'day') {
        $stats = $approvedBookings->whereDate('created_at', Carbon::today())
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('H'); // Group by hour
            });
    } elseif ($period === 'week') {
        $stats = $approvedBookings->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('l'); // Group by day name
            });
    } else { // Default: Month
        $stats = $approvedBookings->whereMonth('created_at', Carbon::now()->month)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('d'); // Group by day of the month
            });
    }

    // Prepare data for the chart
    $labels = $stats->keys();
    $data = $stats->map(function ($group) {
        return count($group);
    });

    return response()->json([
        'labels' => $labels,
        'data' => $data,
    ]);
}


    public function reject($id)
    {
        try {
            $booking = Booking::findOrFail($id);

            // Update the status of the car to 'available'
            $car = Car::find($booking->car_id);
            $car->status = 'available';
            $car->save();

            // Update the status of the sopir to 'available' if a sopir is associated
            if ($booking->sopir_id) {
                $sopir = Sopir::find($booking->sopir_id);
                $sopir->status = 'available';
                $sopir->save();
            }

            $booking->delete();

            return redirect()->route('dashboard')->with('success', 'Booking has been rejected and deleted successfully!');
        } catch (\Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }
    }
}
