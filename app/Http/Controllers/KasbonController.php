<?php

namespace App\Http\Controllers;

use App\Models\Kasbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasbonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kasbon::latest()->get();
        return view('admin.kasbon.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kasbon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'nama' => 'required',
            'nominal' => 'required',
        ]);

        Kasbon::create([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'nominal' => $request->nominal,
        ]);
    
        return redirect()->route('kasbon.index')->with('toast_success', 'Data berhasil disimpan');
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
        $data = Kasbon::where('id_kasbon', $id)->first();
        if (!$data) {
            return redirect()->route('kasbon.index')->with('error', 'Data tidak ditemukan');
        }
        return view('admin.kasbon.edit', compact('data'));
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
        $request->validate([
            'tanggal' => 'required',
            'nama' => 'required',
            'nominal' => 'required',
            'status' => 'required|in:belum_bayar,sudah_bayar',
            'tanggal_pembayaran' => 'nullable|required_if:status,sudah_bayar',
        ]);

        DB::table('kasbons')->where('id_kasbon', $id)->update([
            'tanggal'            => $request->tanggal,
            'nama'               => $request->nama,
            'nominal'            => $request->nominal,
            'status'             => $request->status,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
        ]);

        return redirect()->route('kasbon.index')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kasbons')->where('id_kasbon', $id)->delete();
        return redirect()->route('kasbon.index')->with('info', 'Data Berhasil Dihapus!');
    }
}
