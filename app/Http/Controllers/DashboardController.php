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
        $cars = Car::all();
        $approvedBookings = Booking::where('status', 'approved')->get();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $availableCars = Car::where('status', 'available')->count();
        $unavailableCars = Car::where('status', 'unavailable')->count();
        $availableSopirs = Sopir::where('status', 'available')->count();
        return view('dashboard', compact('bookings', 'cars', 'availableSopirs', 'unavailableCars', 'pendingBookings', 'availableCars', 'approvedBookings'));
    }

    // public function reject($id)
    // {
    //     try {
    //         $booking = Booking::findOrFail($id);

    //         if($booking->car_id){
    //             $car = Car::find($booking->car_id);
    //             $car->status = 'available';
    //             $car->save();
    //         }

    //         if ($booking->sopir_id) {
    //             $sopir = Sopir::find($booking->sopir_id);
    //             $sopir->status = 'available';
    //             $sopir->save();
    //         }

    //         $booking->delete();

    //         return redirect()->route('dashboard')->with('success', 'Booking has been rejected and deleted successfully!');
    //     } catch (\Throwable $th) {
    //         return back()->with(['error' => $th->getMessage()]);
    //     }
    // }
}
