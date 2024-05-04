<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengajuan::latest()->get();
        $kategori = Kategori::all();
        return view('admin.pengajuan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.pengajuan.create', compact('kategori'));
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
            'kategori_id'   => 'required',
            'uraian'        => 'required',
            'jumlah_biaya'  => 'required',
        ]);

        Pengajuan::create([
            'kategori_id'   => $request->kategori_id,
            'uraian'        => $request->uraian,
            'jumlah_biaya'  => $request->jumlah_biaya,
            'status'        => 'pending',
        ]);

        return redirect()->route('pengajuan.index')->with('toast_success', 'Data berhasil disimpan');
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
        $kategori = Kategori::all();
        $data = Pengajuan::find($id);
        return view('admin.pengajuan.edit', compact('data', 'kategori'));
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
            'kategori_id'   => 'required',
            'uraian'    => 'required',
            'jumlah_biaya'    => 'required',
        ]);

        DB::table('pengajuans')->where('id_pengajuan', $id)->update([
            'kategori_id'   => $request->kategori_id,
            'uraian'        => $request->uraian,
            'jumlah_biaya'  => $request->jumlah_biaya,
            'status'        => 'pending',
        ]);

        return redirect()->route('pengajuan.index')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pengajuans')->where('id_pengajuan', $id)->delete();
        return redirect()->route('pengajuan.index')->with('info', 'Data Berhasil Dihapus!');
    }

    public function approve(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'approved';
        $pengajuan->save();

        return redirect()->route('pengajuan.index')->with('toast_success', 'Pengajuan disetujui!');
    }

    public function reject(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'rejected';
        $pengajuan->save();

        return redirect()->route('pengajuan.index')->with('toast_success', 'Pengajuan ditolak!');
    }
}