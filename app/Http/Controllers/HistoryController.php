<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\History;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = Booking::where('status', 'approved')->get();
        return view('history.index', compact('histories'));
    }

    public function cetak(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $histories = Booking::whereBetween('tanggal_pinjam', [$start_date, $end_date])->get();

        return view('history.cetak', compact('histories', 'start_date', 'end_date'));
    }

    
    public function cetakPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $histories = Booking::whereBetween('tanggal_pinjam', [$start_date, $end_date])->get();

        $pdf = PDF::loadView('history.pdf', compact('histories', 'start_date', 'end_date'));
        return $pdf->download('laporan_peminjaman.pdf');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
