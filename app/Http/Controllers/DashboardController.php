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
        // Ambil saldo awal
        $saldoAwal = Saldo::first()->saldo_awal ?? 0;
        $saldoSaatIni = Saldo::first()->saldo ?? 0;

        // Hitung total pengeluaran dan pemasukan
        $pengeluaran = Pengeluaran::sum('jumlah') ?? 0;
        $pemasukan = Pemasukan::sum('jumlah') ?? 0;

        // Ambil jumlah user
        // $jumlahUser = User::count();

        // Jumlah pemasukan dan pengeluaran bulan ini
        $currentMonth = Carbon::now()->month;
        $pemasukanBulanIni = Pemasukan::whereMonth('tanggal', $currentMonth)->sum('jumlah') ?? 0;
        $pengeluaranBulanIni = Pengeluaran::whereMonth('tanggal', $currentMonth)->sum('jumlah') ?? 0;

        // Jumlah pemasukan dan pengeluaran tahun ini
        $currentYear = Carbon::now()->year;
        $pemasukanTahunIni = Pemasukan::whereYear('tanggal', $currentYear)->sum('jumlah') ?? 0;
        $pengeluaranTahunIni = Pengeluaran::whereYear('tanggal', $currentYear)->sum('jumlah') ?? 0;

        return view('dashboard', [
            'saldoAwal' => $saldoAwal,
            'saldoSaatIni' => $saldoSaatIni,
            'pengeluaran' => $pengeluaran, 
            'pemasukan' => $pemasukan, 
            // 'jumlahUser' => $jumlahUser,
            'pemasukanBulanIni' => $pemasukanBulanIni, 
            'pengeluaranBulanIni' => $pengeluaranBulanIni, 
            'pemasukanTahunIni' => $pemasukanTahunIni, 
            'pengeluaranTahunIni' => $pengeluaranTahunIni
        ]);
    }
}
