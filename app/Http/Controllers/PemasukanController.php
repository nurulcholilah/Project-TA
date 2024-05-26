<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pemasukan::latest()->get();
        return view('admin.pemasukan.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pemasukan.create');
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
            'tanggal'   => 'required|string',
            'uraian'    => 'required',
            'jumlah'    => 'required',
        ]);

        $tahun = date('Y', strtotime($request->tanggal));
        $saldoAwal = Saldo::whereYear('tanggal', $tahun)->first();
        if (!$saldoAwal) {
            return redirect()->route('pemasukan.index')->with('error', 'Saldo untuk tahun ' . $tahun . ' belum dibuat.');
        }

        Pemasukan::create([
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'jumlah' => $request->jumlah,
        ]);

        $saldoAwal->saldo += $request->jumlah;
        $saldoAwal->save();

        return redirect()->route('pemasukan.index')->with('toast_success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pemasukan::where('id_pemasukan', $id)->first();
        if (!$data) {
            return redirect()->route('pemasukan.index')->with('error', 'Data tidak ditemukan');
        }
        return view('admin.pemasukan.edit', compact('data'));
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
            'tanggal'   => 'required|string',
            'uraian'    => 'required',
            'jumlah'    => 'required',
        ]);

        $pemasukan = Pemasukan::find($id);
        $selisihJumlah = $request->jumlah - $pemasukan->jumlah;

        $tahun = date('Y', strtotime($request->tanggal));
        $saldoAwal = Saldo::whereYear('tanggal', $tahun)->first();
        if (!$saldoAwal) {
            return redirect()->route('pemasukan.index')->with('error', 'Saldo untuk tahun ' . $tahun . ' belum dibuat.');
        }

        $pemasukan->update([
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'jumlah' => $request->jumlah,
        ]);

        $saldoAwal->saldo += $selisihJumlah;
        $saldoAwal->save();

        return redirect()->route('pemasukan.index')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $tahun = date('Y', strtotime($pemasukan->tanggal));
        $saldoAwal = Saldo::whereYear('tanggal', $tahun)->first();
        if (!$saldoAwal) {
            return redirect()->route('pemasukan.index')->with('error', 'Saldo untuk tahun ' . $tahun . ' belum dibuat.');
        }
        $saldoAwal->saldo -= $pemasukan->jumlah;
        $saldoAwal->save();
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('info', 'Data Berhasil Dihapus!');
    }
}
