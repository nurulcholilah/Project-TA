<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil saldo awal sesuai dengan tahun saat ini
        $currentYear = Carbon::now()->year;
        $saldoAwal = Saldo::whereYear('created_at', $currentYear)->first()->saldo_awal ?? 0;
        $saldoSaatIni = Saldo::first()->saldo ?? 0;

        // Hitung total pengeluaran dan pemasukan
        $pengeluaran = Pengeluaran::sum('jumlah') ?? 0;
        $pemasukan = Pemasukan::sum('jumlah') ?? 0;

        // Ambil bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;

        // Jumlah pemasukan bulan ini
        $pemasukanBulanIni = Pemasukan::whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah') ?? 0;

        // Jumlah pengeluaran bulan ini
        $pengeluaranBulanIni = Pengeluaran::whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah') ?? 0;

        // Jumlah pemasukan tahun ini
        $pemasukanTahunIni = Pemasukan::whereYear('tanggal', $currentYear)->sum('jumlah') ?? 0;

        // Jumlah pengeluaran tahun ini
        $pengeluaranTahunIni = Pengeluaran::whereYear('tanggal', $currentYear)->sum('jumlah') ?? 0;

        return view('dashboard', [
            'saldoAwal' => $saldoAwal,
            'saldoSaatIni' => $saldoSaatIni,
            'pengeluaran' => $pengeluaran,
            'pemasukan' => $pemasukan,
            'pemasukanBulanIni' => $pemasukanBulanIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'pemasukanTahunIni' => $pemasukanTahunIni,
            'pengeluaranTahunIni' => $pengeluaranTahunIni
        ]);
    }
}
