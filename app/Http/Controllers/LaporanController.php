<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $year = $request->input('year');

        // Fetch Pemasukan data
        $pemasukanQuery = Pemasukan::query();
        if ($start_date && $end_date) {
            $pemasukanQuery->whereBetween('tanggal', [$start_date, $end_date]);
        }
        if ($year) {
            $pemasukanQuery->whereYear('tanggal', $year);
        }
        $pemasukan = $pemasukanQuery->get();

        // Fetch Pengeluaran data
        $pengeluaranQuery = Pengeluaran::query();
        if ($start_date && $end_date) {
            $pengeluaranQuery->whereBetween('tanggal', [$start_date, $end_date]);
        }
        if ($year) {
            $pengeluaranQuery->whereYear('tanggal', $year);
        }
        $pengeluaran = $pengeluaranQuery->get();

        // Merge and sort the income and expenses
        $data = $pemasukan->merge($pengeluaran)->sortBy('tanggal')->values();

        return view('admin.laporan.index', compact('data'));
    }

    public function exportPDF(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $year = $request->input('year');

        // Ensure all variables are defined, even if they are null
        $start_date = $start_date ?? null;
        $end_date = $end_date ?? null;
        $year = $year ?? null;

        // Fetch Pemasukan data
        $pemasukanQuery = Pemasukan::query();
        if ($start_date && $end_date) {
            $pemasukanQuery->whereBetween('tanggal', [$start_date, $end_date]);
        }
        if ($year) {
            $pemasukanQuery->whereYear('tanggal', $year);
        }
        $pemasukan = $pemasukanQuery->get();

        // Fetch Pengeluaran data
        $pengeluaranQuery = Pengeluaran::query();
        if ($start_date && $end_date) {
            $pengeluaranQuery->whereBetween('tanggal', [$start_date, $end_date]);
        }
        if ($year) {
            $pengeluaranQuery->whereYear('tanggal', $year);
        }
        $pengeluaran = $pengeluaranQuery->get();

        // Merge and sort the income and expenses
        $data = $pemasukan->merge($pengeluaran)->sortBy('tanggal')->values();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.laporan.pdf', compact('data', 'start_date', 'end_date', 'year'));

        return $pdf->download('laporan.pdf');
    }
}
