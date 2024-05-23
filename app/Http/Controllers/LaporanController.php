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

        // Ambil saldo awal dari tabel `saldos` sesuai dengan tahun yang dipilih
        $saldoAwal = 0;
        if ($year) {
            $saldoAwal = Saldo::whereYear('tanggal', $year)->sum('saldo_awal');
        } elseif ($startDate && $endDate) {
            // Calculate saldo awal based on the earliest date within the provided date range
            $saldoAwal = Saldo::where('tanggal', '<', $startDate)->sum('saldo_awal');
        }

        // Inisialisasi data sebagai koleksi kosong
        $data = collect();

        // Hanya ambil data jika ada filter yang diberikan
        if ($year || ($startDate && $endDate)) {
            // Fetch Pemasukan data
            $pemasukanQuery = Pemasukan::query();
            if ($startDate && $endDate) {
                $pemasukanQuery->whereBetween('tanggal', [$startDate, $endDate]);
            }
            if ($year) {
                $pemasukanQuery->whereYear('tanggal', $year);
            }
            $pemasukan = $pemasukanQuery->get();

            // Fetch Pengeluaran data
            $pengeluaranQuery = Pengeluaran::query();
            if ($startDate && $endDate) {
                $pengeluaranQuery->whereBetween('tanggal', [$startDate, $endDate]);
            }
            if ($year) {
                $pengeluaranQuery->whereYear('tanggal', $year);
            }
            $pengeluaran = $pengeluaranQuery->get();

            // Gabungkan dan urutkan data berdasarkan tanggal
            $data = $pemasukan->concat($pengeluaran)->sortBy('tanggal');
        }

        return view('admin.laporan.index', compact('data', 'saldoAwal', 'year'));
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

        // Ambil saldo awal dari tabel `saldos` sesuai dengan tahun yang dipilih
        $saldoAwal = 0;
        if ($year) {
            $saldoAwal = Saldo::whereYear('tanggal', $year)->sum('saldo_awal');
        } elseif ($start_date && $end_date) {
            // Calculate saldo awal based on the earliest date within the provided date range
            $saldoAwal = Saldo::where('tanggal', '<', $start_date)->sum('saldo_awal');
        }

        // Inisialisasi data sebagai koleksi kosong
        $data = collect();

        // Hanya ambil data jika ada filter yang diberikan
        if ($year || ($start_date && $end_date)) {
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

            // Gabungkan dan urutkan data berdasarkan tanggal
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
