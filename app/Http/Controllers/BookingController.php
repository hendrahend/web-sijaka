<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Sopir;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch vehicles from the database (or define a static list)
        $cars = Car::all(); 
        $approvedBookings = Booking::where('status', 'approved')->get();
        return view('bookings.index', compact('cars', 'approvedBookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $cars = Car::where('status', 'available')->get();
        $drivers = Sopir::where('status', 'available')->get();
        return view('bookings.create', compact('user', 'cars', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'kegiatan' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'selesai_pinjam' => 'required|date',
            'car_id' => 'required|exists:cars,id',
            'sopir_id' => 'nullable|exists:sopirs,id',
        ]);
        // dd($user->name);
        try {
            Booking::create([
                'name' => $user->name,
                'nip' => $user->nip,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'selesai_pinjam' => $request->selesai_pinjam,
                'car_id' => $request->car_id,
                'sopir_id' => $request->sopir_id,
                'kegiatan' => $request->kegiatan,
                'catatan' => $request->catatan,
            ]);

            $car = Car::find($request->car_id);
            $car->status = 'unavailable';
            $car->save();

            // Update the status of the sopir to 'unavailable' if a sopir is selected
            if ($request->sopir_id) {
                $sopir = Sopir::find($request->sopir_id);
                $sopir->status = 'unavailable';
                $sopir->save();
            }

            return redirect()->route('bookings.index')->with('success', 'Booking has been created successfully!');
        } catch (\Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function approve($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->status = 'approved';
            $booking->save();

            return redirect()->route('dashboard')->with('success', 'Booking has been approved successfully!');
        } catch (\Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }
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
    
    public function calendar()
    {
        $approvedBookings = Booking::where('status', 'approved')->get();
        return view('bookings.calendar', compact('approvedBookings'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
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

            return redirect()->route('bookings.index')->with('success', 'Booking has been deleted successfully!');
        } catch (\Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }
    }
}
