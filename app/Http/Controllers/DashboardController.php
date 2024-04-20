<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use App\Models\User;
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
        $pengeluaran = Pengeluaran::sum('jumlah');
        $pemasukan = Pemasukan::sum('jumlah');
        $totalSaldo = Saldo::sum('saldo');
        $jumlahUser = User::count();

        // Jumlah pemasukan dan pengeluaran bulan ini
        $currentMonth = Carbon::now()->month;
        $pemasukanBulanIni = Pemasukan::whereMonth('tanggal', $currentMonth)->sum('jumlah');
        $pengeluaranBulanIni = Pengeluaran::whereMonth('tanggal', $currentMonth)->sum('jumlah');

        // Jumlah pemasukan dan pengeluaran tahun ini
        $currentYear = Carbon::now()->year;
        $pemasukanTahunIni = Pemasukan::whereYear('tanggal', $currentYear)->sum('jumlah');
        $pengeluaranTahunIni = Pengeluaran::whereYear('tanggal', $currentYear)->sum('jumlah');

        return view('dashboard', [
            'pengeluaran' => $pengeluaran, 
            'pemasukan' => $pemasukan, 
            'totalSaldo' => $totalSaldo, 
            'jumlahUser' => $jumlahUser, 
            'pemasukanBulanIni' => $pemasukanBulanIni, 
            'pengeluaranBulanIni' => $pengeluaranBulanIni, 
            'pemasukanTahunIni' => $pemasukanTahunIni, 
            'pengeluaranTahunIni' => $pengeluaranTahunIni
        ]);

        
    }

    // public function get(){
    //     $user = User::all();
    //     return view('dashboard', compact('user'));
    // }
}
