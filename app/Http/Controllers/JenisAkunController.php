<?php

namespace App\Http\Controllers;

use App\Models\JenisAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JenisAkun::latest()->get();
        return view('admin.jenisakun.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jenisakun.create');
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
        ]);

        JenisAkun::create([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('jenisakun.index')->with('toast_success', 'Data berhasil disimpan');
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
        $data = JenisAkun::where('id_jenis_akun', $id)->first();
        if (!$data) {
            return redirect()->route('jenisakun.index')->with('error', 'Data tidak ditemukan');
        }
        return view('admin.jenisakun.edit', compact('data'));
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
        ]);

        DB::table('jenis_akuns')->where('id_jenis_akun', $id)->update([
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('jenisakun.index')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('jenis_akuns')->where('id_jenis_akun', $id)->delete();
        return redirect()->route('jenisakun.index')->with('info', 'Data Berhasil Dihapus!');
    }
}
