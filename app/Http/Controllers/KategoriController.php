<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Dapatkan saldo terbaru dari tabel saldos
        $saldo = DB::table('saldos')->latest('tanggal')->value('saldo');

        // Dapatkan total jumlah dari semua entri dalam tabel kategoris
        $totalKategori = DB::table('kategoris')->sum('jumlah');

        // Validasi jumlah agar tidak melebihi saldo yang ada
        if ($totalKategori + $request->jumlah > $saldo) {
            // return redirect()->route('kategori.create')->with('error', 'Jumlah tidak boleh melebihi saldo yang ada.');
            return redirect()->back()->withInput();
        }

        Kategori::create([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('kategori.index')->with('toast_success', 'Data berhasil disimpan');
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
            return redirect()->route('kategori.index')->with('error', 'Data tidak ditemukan');
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

        // Dapatkan saldo terbaru dari tabel saldos
        $saldo = DB::table('saldos')->latest('tanggal')->value('saldo');

        // Dapatkan total jumlah dari semua entri dalam tabel kategoris, kecuali yang sedang diupdate
        $totalKategori = DB::table('kategoris')->where('id_kategori', '!=', $id)->sum('jumlah');

        // Validasi jumlah agar tidak melebihi saldo yang ada
        if ($totalKategori + $request->jumlah > $saldo) {
            // return redirect()->route('kategori.edit')->with('error', 'Jumlah tidak boleh melebihi saldo yang ada.');
            return redirect()->back()->withInput();
        }

        // Update data kategori
        DB::table('kategoris')->where('id_kategori', $id)->update([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('kategori.index')->with('toast_success', 'Data Berhasil Disimpan!');
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
        return redirect()->route('kategori.index')->with('info', 'Data Berhasil Dihapus!');
    }
}
