<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $saldoAwal = 0;
        if ($year) {
            $saldoAwal = Saldo::whereYear('tanggal', $year)->sum('saldo_awal');
        } elseif ($startDate && $endDate) {
            $saldoAwal = Saldo::where('tanggal', '<', $startDate)->sum('saldo_awal');
        }

        $data = collect();
        if ($year || ($startDate && $endDate)) {
            $pemasukanQuery = Pemasukan::query();
            if ($startDate && $endDate) {
                $pemasukanQuery->whereBetween('tanggal', [$startDate, $endDate]);
            }
            if ($year) {
                $pemasukanQuery->whereYear('tanggal', $year);
            }
            $pemasukan = $pemasukanQuery->get();

            $pengeluaranQuery = Pengeluaran::query();
            if ($startDate && $endDate) {
                $pengeluaranQuery->whereBetween('tanggal', [$startDate, $endDate]);
            }
            if ($year) {
                $pengeluaranQuery->whereYear('tanggal', $year);
            }
            $pengeluaran = $pengeluaranQuery->get();
            $data = $pemasukan->concat($pengeluaran)->sortBy('tanggal');
        }

        return view('admin.laporan.index', compact('data', 'saldoAwal', 'year'));
    }

    public function exportPDF(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $year = $request->input('year');

        $start_date = $start_date ?? null;
        $end_date = $end_date ?? null;
        $year = $year ?? null;

        $saldoAwal = 0;
        if ($year) {
            $saldoAwal = Saldo::whereYear('tanggal', $year)->sum('saldo_awal');
        } elseif ($start_date && $end_date) {
            $saldoAwal = Saldo::where('tanggal', '<', $start_date)->sum('saldo_awal');
        }

        $data = collect();
        if ($year || ($start_date && $end_date)) {
            $pemasukanQuery = Pemasukan::query();
            if ($start_date && $end_date) {
                $pemasukanQuery->whereBetween('tanggal', [$start_date, $end_date]);
            }
            if ($year) {
                $pemasukanQuery->whereYear('tanggal', $year);
            }
            $pemasukan = $pemasukanQuery->get();

            $pengeluaranQuery = Pengeluaran::query();
            if ($start_date && $end_date) {
                $pengeluaranQuery->whereBetween('tanggal', [$start_date, $end_date]);
            }
            if ($year) {
                $pengeluaranQuery->whereYear('tanggal', $year);
            }
            $pengeluaran = $pengeluaranQuery->get();
            $data = $pemasukan->concat($pengeluaran)->sortBy('tanggal');
        }

        if ($data->count() > 0) {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('admin.laporan.pdf', compact('data', 'start_date', 'end_date', 'year', 'saldoAwal'));
            return $pdf->download('laporan.pdf');
        } else {
            return redirect()->back()->with('error', 'Silakan filter data terlebih dahulu sebelum mengekspor sebagai PDF.');
        }
    }
}
