<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::when(request()->search, function ($cars) {
            $cars = $cars->where('name', 'like', '%' . request()->search . '%');
        })->paginate(10);

        return view('cars.index', compact('cars'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nopol' => 'required|string|max:255',
            'image' => 'nullable|url|max:255',
        ]);

        try {
            Car::create([
                'name' => $request->name,
                'nopol' => $request->nopol,
                'image' => $request->image,
                'status' => $request->status
            ]);

            return redirect()->route('cars.index')
                ->with('success', 'Car has been created successfully!');
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
        $car = Car::findOrFail($id);
        $statuses = Car::select('status')->distinct()->get();
        return view('cars.edit', compact('car', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $car = Car::findOrFail($id);
            $car->update([
                'name' => $request->name,
                'nopol' => $request->nopol,
                'image' => $request->image,
                'status' => $request->status,
            ]);
            return redirect()->route('cars.index')
            ->with('success', 'Car '.$car->name.' has been updated successfully!');
        } catch (\Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if($car) {
            $car->delete();
            return redirect()->route('cars.index')
            ->with('success', 'Car '.$car->name.' has been deleted successfully!');
        } else { 
            return back()->with(['error' => 'Car not found.']);
        }
    }
}
