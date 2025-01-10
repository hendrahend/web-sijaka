<?php

namespace App\Http\Controllers;

use App\Models\Sopir;
use Illuminate\Http\Request;

class SopirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sopirs = Sopir::when(request()->search, function ($sopirs) {
            $sopirs = $sopirs->where('name', 'like', '%' . request()->search . '%');
        })->paginate(10);
        return view('sopirs.index', compact('sopirs'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sopirs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
        ]);

        try {
            $sopir = new Sopir([
                'name'  => $request->name,
                'no_wa' => $request->no_wa,
            ]);
            $sopir->save();
            return redirect()->route('sopirs.index')
            ->with('success', 'Sopir '.$sopir->name.' has been created successfully!');
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
    public function edit(Sopir $sopir)
    {
        return view('sopirs.edit', compact('sopir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
        ]);

        try {
            $sopir = Sopir::findOrFail($id);
            $sopir->update([
                'name'  => $request->name,
                'no_wa' => $request->no_wa,
            ]);
            return redirect()->route('sopirs.index')
                ->with('success', 'Sopir '.$sopir->name.' has been updated successfully!');
        } catch (\Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sopir $sopir)
    {
        if($sopir) {
            $sopir->delete();
            return redirect()->route('sopirs.index')
            ->with('success', 'Sopir '.$sopir->name.' has been deleted successfully!');
        } else { 
            return back()->with(['error' => 'Sopir not found.']);
        }
    }
}
