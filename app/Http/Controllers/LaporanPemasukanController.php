<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Saldo;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPemasukanController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $year = $request->input('year');

        $dataQuery = Pemasukan::query();

        if ($start_date && $end_date) {
            $dataQuery->whereBetween('tanggal', [$start_date, $end_date]);
        }

        if ($year) {
            $dataQuery->whereYear('tanggal', $year);
        }

        $data = $dataQuery->get();
        $totalPemasukan = $data->sum('jumlah');

        return view('admin.laporan.pemasukan', compact('data', 'totalPemasukan', 'year'));
    }

    public function exportPDF(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $year = $request->input('year');

        if ($start_date || $end_date || $year) {
            if ($start_date && $end_date) {
                $data = Pemasukan::whereBetween('tanggal', [$start_date, $end_date])->get();
            } elseif ($year) {
                $data = Pemasukan::whereYear('tanggal', $year)->get();
            } else {
                $data = Pemasukan::latest()->get();
            }

            $totalPemasukan = $data->sum('jumlah');

            $pdf = app('dompdf.wrapper');
            $pdf->loadView('admin.laporan.pemasukan_pdf', compact('data', 'totalPemasukan', 'start_date', 'end_date', 'year'));

            return $pdf->download('laporan_pemasukan.pdf');
        } else {
            return redirect()->back()->with('error', 'Silakan filter data terlebih dahulu sebelum mengekspor sebagai PDF.');
        }
    }
}