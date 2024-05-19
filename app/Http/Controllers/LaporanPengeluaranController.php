<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $year = $request->input('year');

        $dataQuery = Pengeluaran::query();

        if ($start_date && $end_date) {
            $dataQuery->whereBetween('tanggal', [$start_date, $end_date]);
        }

        if ($year) {
            $dataQuery->whereYear('tanggal', $year);
        }

        $data = $dataQuery->get();
        $totalPengeluaran = $data->sum('jumlah');
        $saldo = Saldo::first()->saldo ?? 0;

        return view('admin.laporan.pengeluaran', compact('data', 'totalPengeluaran', 'saldo', 'year'));
    }

    public function exportPDF(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $year = $request->input('year');

        if ($start_date && $end_date) {
            $data = Pengeluaran::whereBetween('tanggal', [$start_date, $end_date])->first()->get();
        } elseif ($year) { 
            $data = Pengeluaran::whereYear('tanggal', $year)->first()->get();
        } else {
            $data = Pengeluaran::latest()->get();
        }

        $totalPengeluaran = $data->sum('jumlah');
        $saldo = Saldo::first()->saldo ?? 0;

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.laporan.pengeluaran_pdf', compact('data', 'totalPengeluaran', 'saldo', 'start_date', 'end_date', 'year'));

        return $pdf->download('laporan_pengeluaran.pdf');
    }
}