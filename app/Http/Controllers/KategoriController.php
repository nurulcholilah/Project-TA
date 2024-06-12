<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kategori::latest()->get();
        return view('admin.kategori.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
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
            'kode' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $saldo_awal = DB::table('saldos')->latest('tanggal')->value('saldo_awal');
        $totalKategori = DB::table('kategoris')->sum('jumlah');
        if ($totalKategori + $request->jumlah > $saldo_awal) {
            Alert::error('Jumlah dana melebihi saldo');
            return redirect()->back()->withInput();
        }

        Kategori::create([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
        ]);

        Alert::success('Data berhasil disimpan');
        return redirect()->route('kategori.index');
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
        $data = Kategori::where('id_kategori', $id)->first();
        if (!$data) {
            Alert::error('Data tidak ditemukan');
            return redirect()->route('kategori.index');
        }
        return view('admin.kategori.edit', compact('data'));
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
            'kode' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $saldo_awal = DB::table('saldos')->latest('tanggal')->value('saldo_awal');
        $totalKategori = DB::table('kategoris')->where('id_kategori', '!=', $id)->sum('jumlah');
        if ($totalKategori + $request->jumlah > $saldo_awal) {
            Alert::error('Jumlah dana melebihi saldo');
            return redirect()->back()->withInput();
        }

        DB::table('kategoris')->where('id_kategori', $id)->update([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
        ]);

        Alert::success('Data berhasil diedit');
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kategoris')->where('id_kategori', $id)->delete();
        Alert::success('Data berhasil dihapus');
        return redirect()->route('kategori.index');
    }
}
