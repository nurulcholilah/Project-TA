<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengeluaran::latest()->get();
        return view('admin.pengeluaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::today()->format('d/m/Y');
        $kategori = Kategori::all();
        return view('admin.pengeluaran.create', compact('today', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file'        => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,pdf|max:2048',
            'tanggal'     => 'required',
            'kode_akun'   => 'required',
            'kategori_id' => 'required',
            'uraian'      => 'required',
            'penerima'    => 'required',
            'jumlah'      => 'required',
            'spj'         => 'required',
            'tdspj'       => 'required',
        ]);

        if ($request->spj + $request->tdspj != $request->jumlah) {
            return redirect()->back()->withInput()->withErrors(['spj' => 'Jumlah SPJ dan Tidak SPJ harus sama dengan Jumlah']);
        }

        $destinationPath = 'assets/images/file';
        $file = $request->file('file');
        $myfile = $file->getClientOriginalName();
        $file->move(public_path($destinationPath), $myfile);

        $tahun = date('Y', strtotime($request->tanggal));
        $saldoAwal = Saldo::whereYear('tanggal', $tahun)->first();
        if (!$saldoAwal) {
            Alert::error('Saldo untuk tahun ' . $tahun . ' belum dibuat.');
            return redirect()->route('pengeluaran.index');
        }

        $saldoAwal->saldo -= $request->jumlah;
        $saldoAwal->save();

        Pengeluaran::create([
            'file'        => $myfile,
            'tanggal'     => $request->tanggal,
            'kode_akun'   => $request->kode_akun,
            'kategori_id' => $request->kategori_id,
            'uraian'      => $request->uraian,
            'penerima'    => $request->penerima,
            'jumlah'      => $request->jumlah,
            'spj'         => $request->spj,
            'tdspj'       => $request->tdspj,
        ]);

        Alert::success('Data berhasil disimpan');
        return redirect()->route('pengeluaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pengeluaran::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.pengeluaran.show', compact('data', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::all();
        $data = Pengeluaran::find($id);
        return view('admin.pengeluaran.edit', compact('data', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file'        => 'file|mimes:jpeg,png,jpg,gif,svg,webp,pdf|max:2048',
            'tanggal'     => 'required',
            'kode_akun'   => 'required',
            'kategori_id' => 'required',
            'uraian'      => 'required',
            'penerima'    => 'required',
            'jumlah'      => 'required',
            'spj'         => 'required',
            'tdspj'       => 'required',
        ]);

        if ($request->spj + $request->tdspj != $request->jumlah) {
            return redirect()->back()->withInput()->withErrors(['spj' => 'Jumlah SPJ dan Tidak SPJ harus sama dengan Jumlah']);
        }

        $pengeluaran = Pengeluaran::find($id);
        $selisihJumlah = $request->jumlah - $pengeluaran->jumlah;
        $tahun = date('Y', strtotime($request->tanggal));
        $saldoAwal = Saldo::whereYear('tanggal', $tahun)->first();
        if (!$saldoAwal) {
            Alert::error('Saldo untuk tahun ' . $tahun . ' belum dibuat.');
            return redirect()->route('pengeluaran.index');
        }

        $saldoAwal->saldo -= $selisihJumlah;
        $saldoAwal->save();

        if ($request->hasFile('file')) {
            $oldFilePath = public_path('assets/images/file/' . $pengeluaran->file);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            $file = $request->file('file');
            $destinationPath = 'assets/images/file';
            $myfile = $file->getClientOriginalName();
            $file->move(public_path($destinationPath), $myfile);

            $pengeluaran->file = $myfile;
        }

        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->kode_akun = $request->kode_akun;
        $pengeluaran->kategori_id = $request->kategori_id;
        $pengeluaran->uraian = $request->uraian;
        $pengeluaran->penerima = $request->penerima;
        $pengeluaran->jumlah = $request->jumlah;
        $pengeluaran->spj = $request->spj;
        $pengeluaran->tdspj = $request->tdspj;
        $pengeluaran->save();

        Alert::success('Data berhasil diedit');
        return redirect()->route('pengeluaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $tahun = date('Y', strtotime($pengeluaran->tanggal));
        $saldoAwal = Saldo::whereYear('tanggal', $tahun)->first();
        if (!$saldoAwal) {
            Alert::error('Saldo untuk tahun ' . $tahun . ' belum dibuat.');
            return redirect()->route('pengeluaran.index');
        }
        $saldoAwal->saldo += $pengeluaran->jumlah;
        $saldoAwal->save();
        $pengeluaran->delete();
        Alert::success('Data berhasil dihapus');
        return redirect()->route('pengeluaran.index');
    }
}
