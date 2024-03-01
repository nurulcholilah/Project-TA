<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Saldo;
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
            'kode'          => 'required',
            'keterangan'    => 'required',
            'saldo'         => 'required',
        ]);

       // Ambil nilai saldo dari tabel saldo
       $saldo = Saldo::first()->saldo;

        Kategori::create([
            'kode'          => $request->kode,
            'keterangan'    => $request->keterangan,
            'saldo'         => $saldo,
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
        $saldo = Saldo::where('id_saldo', $id);
        return view('admin.kategori.edit', compact('data', 'saldo'));
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
        // Ambil nilai saldo dari tabel saldo
        $saldo = Saldo::first()->saldo;
        DB::table('kategoris')->where('id_kategori', $id)->update([
            'kode'          => $request->kode,
            'keterangan'    => $request->keterangan,
            'saldo'         => $saldo,
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
