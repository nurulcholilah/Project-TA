<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
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
            'tanggal' => 'required',
            'uraian' => 'required',
            'kode' => 'required',
            'keterangan' => 'required|in:SPJ,Tidak SPJ',
            'jum_spj' => 'required_if:keterangan,SPJ',
            'jum_tspj' => 'required_if:keterangan,Tidak SPJ',
        ]);
    
        $jum_spj = $request->keterangan == 'SPJ' ? $request->jum_spj : 0;
        $jum_tspj = $request->keterangan == 'Tidak SPJ' ? $request->jum_tspj : 0;
    
        // Jika keterangan adalah SPJ dan ada data dengan keterangan SPJ
        if ($request->keterangan == 'SPJ' && Pemasukan::where('keterangan', 'SPJ')->exists()) {
            $latest_spj = Pemasukan::where('keterangan', 'SPJ')->latest()->first();
            $jum_spj += $latest_spj->jum_spj;
        }
    
        // Jika keterangan adalah Tidak SPJ dan ada data dengan keterangan Tidak SPJ
        if ($request->keterangan == 'Tidak SPJ' && Pemasukan::where('keterangan', 'Tidak SPJ')->exists()) {
            $latest_tspj = Pemasukan::where('keterangan', 'Tidak SPJ')->latest()->first();
            $jum_tspj += $latest_tspj->jum_tspj;
        }
    
        Pemasukan::create([
            'tanggal' => $request->tanggal,
            'uraian' => $request->uraian,
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'jum_spj' => $jum_spj,
            'jum_tspj' => $jum_tspj,
        ]);
    
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
        'tanggal' => 'required',
        'uraian' => 'required',
        'kode' => 'required',
        'keterangan' => 'required|in:SPJ,Tidak SPJ',
        'jum_spj' => 'required_if:keterangan,SPJ',
        'jum_tspj' => 'required_if:keterangan,Tidak SPJ',
    ]);

    $jum_spj = $request->keterangan == 'SPJ' ? $request->jum_spj : 0;
    $jum_tspj = $request->keterangan == 'Tidak SPJ' ? $request->jum_tspj : 0;

    // Jika keterangan adalah SPJ dan ada data dengan keterangan SPJ
    if ($request->keterangan == 'SPJ' && Pemasukan::where('keterangan', 'SPJ')->exists()) {
        $latest_spj = Pemasukan::where('keterangan', 'SPJ')->where('id_pemasukan', '!=', $id)->latest()->first();
        $jum_spj += $latest_spj->jum_spj;
    }

    // Jika keterangan adalah Tidak SPJ dan ada data dengan keterangan Tidak SPJ
    if ($request->keterangan == 'Tidak SPJ' && Pemasukan::where('keterangan', 'Tidak SPJ')->exists()) {
        $latest_tspj = Pemasukan::where('keterangan', 'Tidak SPJ')->where('id_pemasukan', '!=', $id)->latest()->first();
        $jum_tspj += $latest_tspj->jum_tspj;
    }

    DB::table('pemasukans')->where('id_pemasukan', $id)->update([
        'tanggal'       => $request->tanggal,
        'uraian'        => $request->uraian,
        'kode'          => $request->kode,
        'keterangan'    => $request->keterangan,
        'jum_spj'       => $jum_spj,
        'jum_tspj'      => $jum_tspj,
    ]);

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
        DB::table('pemasukans')->where('id_pemasukan', $id)->delete();
        return redirect()->route('pemasukan.index')->with('info', 'Data Berhasil Dihapus!');
    }
}
