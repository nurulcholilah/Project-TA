<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengeluaran::latest()->get();
        return view('admin.pengeluaran.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengeluaran.create');
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
            'tanggal'   => 'required',
            'uraian'    => 'required',
            'jumlah'    => 'required',
            'spj'       => 'required',
            'tdspj'     => 'required',
        ]);

        // Mengambil total dari semua data yang sudah ada ditambah dengan nilai baru yang dimasukkan
        $total = Pengeluaran::sum('jumlah') + $request->jumlah;

        // Validate if SPJ and Tidak SPJ sum up to Jumlah
        if ($request->spj + $request->tdspj != $request->jumlah) {
            return redirect()->back()->withInput()->withErrors(['spj' => 'Jumlah SPJ dan Tidak SPJ harus sama dengan Jumlah']);
        }

        Pengeluaran::create([
            'tanggal'   => $request->tanggal,
            'uraian'    => $request->uraian,
            'jumlah'    => $request->jumlah,
            'spj'       => $request->spj,
            'tdspj'     => $request->tdspj,
            'total'     => $total,
        ]);

        return redirect()->route('pengeluaran.index')->with('toast_success', 'Data berhasil disimpan');
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
        $data = Pengeluaran::where('id_pengeluaran', $id)->first();
        if (!$data) {
            return redirect()->route('pengeluaran.index')->with('error', 'Data tidak ditemukan');
        }
        return view('admin.pengeluaran.edit', compact('data'));
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
            'tanggal'   => 'required',
            'uraian'    => 'required',
            'jumlah'    => 'required',
            'spj'       => 'required',
            'tdspj'     => 'required',
        ]);

        // Mengambil total dari semua data yang sudah ada dikurangi dengan nilai yang diubah ditambah dengan nilai baru yang dimasukkan
        $total = (Pengeluaran::sum('jumlah') - Pengeluaran::find($id)->jumlah) + $request->jumlah;

        // Validate if SPJ and Tidak SPJ sum up to Jumlah
        if ($request->spj + $request->tdspj != $request->jumlah) {
            return redirect()->back()->withInput()->withErrors(['spj' => 'Jumlah SPJ dan Tidak SPJ harus sama dengan Jumlah']);
        }

        DB::table('pengeluarans')->where('id_pengeluaran', $id)->update([
            'tanggal'   => $request->tanggal,
            'uraian'    => $request->uraian,
            'jumlah'    => $request->jumlah,
            'spj'       => $request->spj,
            'tdspj'     => $request->tdspj,
            'total'     => $total,
        ]);

        return redirect()->route('pengeluaran.index')->with('toast_success', 'Data Berhasil Disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mengambil jumlah yang akan dihapus
        $jumlahToDelete = Pengeluaran::find($id)->jumlah;

        // Mengambil total sekarang
        $total = Pengeluaran::sum('jumlah');

        // Menghitung total baru setelah mengurangi jumlah yang akan dihapus
        $totalAfterDelete = $total - $jumlahToDelete;

        // Mengupdate total di database
        DB::table('pengeluarans')->update([
            'total' => $totalAfterDelete,
        ]);

        // Menghapus data
        DB::table('pengeluarans')->where('id_pengeluaran', $id)->delete();

        return redirect()->route('pengeluaran.index')->with('info', 'Data Berhasil Dihapus!');
    }
}
