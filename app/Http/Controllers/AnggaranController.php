<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Anggaran::latest()->get();
        return view('admin.anggaran.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.anggaran.create');
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
            'kode'   => 'required',
            'kegiatan'    => 'required',
            'volume'    => 'required',
            'jumlah'    => 'required',
        ]);

        Anggaran::create([
            'kode' => $request->kode,
            'kegiatan' => $request->kegiatan,
            'volume' => $request->volume,
            'jumlah' => $request->jumlah,
        ]);

        Alert::success('Data berhasil disimpan');
        return redirect()->route('anggaran.index');
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
        $data = Anggaran::where('id_anggaran', $id)->first();
        if (!$data) {
            Alert::error('Data tidak ditemukan');
            return redirect()->route('anggaran.index');
        }
        return view('admin.anggaran.edit', compact('data'));
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
            'kode'      => 'required',
            'kegiatan'  => 'required',
            'volume'    => 'required',
            'jumlah'    => 'required',
        ]);

        DB::table('anggarans')->where('id_anggaran', $id)->update([
            'kode'       => $request->kode,
            'kegiatan'   => $request->kegiatan,
            'volume'     => $request->volume,
            'jumlah'     => $request->jumlah,
        ]);

        Alert::success('Data berhasil diedit');
        return redirect()->route('anggaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('anggarans')->where('id_anggaran', $id)->delete();
        Alert::success('Data berhasil dihapus');
        return redirect()->route('anggaran.index');
    }
}
