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
        $currentYear = Carbon::now()->year;
        $saldoAwal = Saldo::whereYear('created_at', $currentYear)->first()->saldo_awal ?? 0;
        $saldoSaatIni = Saldo::first()->saldo ?? 0;

        $pengeluaran = Pengeluaran::sum('jumlah') ?? 0;
        $pemasukan = Pemasukan::sum('jumlah') ?? 0;

        $currentMonth = Carbon::now()->month;

        $pemasukanBulanIni = Pemasukan::whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah') ?? 0;

        $pengeluaranBulanIni = Pengeluaran::whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->sum('jumlah') ?? 0;

        $pemasukanTahunIni = Pemasukan::whereYear('tanggal', $currentYear)->sum('jumlah') ?? 0;

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
