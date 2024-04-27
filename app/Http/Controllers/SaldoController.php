<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Saldo::latest()->get();
        return view('admin.saldo.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.saldo.create');
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
            'saldo_awal' => 'required',
            'saldo' => 'required',
            'keterangan' => 'required',
        ]);

        Saldo::create([
            'tanggal' => $request->tanggal,
            'saldo_awal' => $request->saldo_awal,
            'saldo' => $request->saldo,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('saldo.index')->with('toast_success', 'Data berhasil disimpan');
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
        $data = Saldo::where('id_saldo', $id)->first();
        if (!$data) {
            return redirect()->route('saldo.index')->with('error', 'Data tidak ditemukan');
        }
        return view('admin.saldo.edit', compact('data'));
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
        DB::table('saldos')->where('id_saldo', $id)->update([
            'tanggal'       => $request->tanggal,
            'saldo_awal'    => $request->saldo_awal,
            'saldo'         => $request->saldo,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('saldo.index')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('saldos')->where('id_saldo', $id)->delete();
        return redirect()->route('saldo.index')->with('info', 'Data Berhasil Dihapus!');
    }
}
