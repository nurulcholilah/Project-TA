<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengeluaran;
use Carbon\Carbon;
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
        $data = Pengeluaran::leftJoin('kategoris', 'pengeluarans.kategori_id', '=', 'kategoris.id_kategori')
            ->select('pengeluarans.*', 'kategoris.keterangan AS kategori')
            ->orderBy('pengeluarans.id_pengeluaran', 'desc')
            ->get();

        return view('admin.pengeluaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::today()->format('d/m/Y');
        $kategori = Kategori::all();
        return view('admin.pengeluaran.create', compact('today', 'kategori'));
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
            'file'        => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,pdf|max:2048',
            'tanggal'     => 'required',
            'kode_akun'   => 'required',
            'jenis_akun'  => 'required',
            'kategori_id' => 'required',
            'uraian'      => 'required',
            'penerima'    => 'required',
            'jumlah'      => 'required',
            'spj'         => 'required',
            'tdspj'       => 'required',
        ]);

        // Validate if SPJ and Tidak SPJ sum up to Jumlah
        if ($request->spj + $request->tdspj != $request->jumlah) {
            return redirect()->back()->withInput()->withErrors(['spj' => 'Jumlah SPJ dan Tidak SPJ harus sama dengan Jumlah']);
        }

        //upload img
        $destinationPath = 'assets/images/file';
        $file = $request->file('file');
        $myfile = $file->getClientOriginalName();
        $file->move(public_path($destinationPath), $myfile);

        Pengeluaran::create([
            'file'        => $myfile,
            'tanggal'     => $request->tanggal,
            'kode_akun'   => $request->kode_akun,
            'jenis_akun'  => $request->jenis_akun,
            'kategori_id' => $request->kategori_id,
            'uraian'      => $request->uraian,
            'penerima'    => $request->penerima,
            'jumlah'      => $request->jumlah,
            'spj'         => $request->spj,
            'tdspj'       => $request->tdspj,
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
        $data = Pengeluaran::leftJoin('kategoris', 'pengeluarans.kategori_id', '=', 'kategoris.id_kategori')
            ->select('pengeluarans.*', 'kategoris.keterangan AS kategori')
            ->where('pengeluarans.id_pengeluaran', $id)
            ->firstOrFail();
        $kategori = Kategori::all();
        return view('admin.pengeluaran.show', compact('data', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pengeluaran::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.pengeluaran.edit', compact('data', 'kategori'));

        // $data = Pengeluaran::where('id_pengeluaran', $id)->first();
        // if (!$data) {
        //     return redirect()->route('pengeluaran.index')->with('error', 'Data tidak ditemukan');
        // }
        // return view('admin.pengeluaran.edit', compact('data'));
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
            'file'        => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,pdf|max:2048',
            'tanggal'     => 'required',
            'kode_akun'   => 'required',
            'jenis_akun'  => 'required',
            'kategori_id' => 'required',
            'uraian'      => 'required',
            'penerima'    => 'required',
            'jumlah'      => 'required',
            'spj'         => 'required',
            'tdspj'       => 'required',
        ]);

        // Validate if SPJ and Tidak SPJ sum up to Jumlah
        if ($request->spj + $request->tdspj != $request->jumlah) {
            return redirect()->back()->withInput()->withErrors(['spj' => 'Jumlah SPJ dan Tidak SPJ harus sama dengan Jumlah']);
        }

        $pengeluaran = Pengeluaran::find($id);

        if ($request->hasFile('file')) {
            $oldFilePath = public_path('assets/images/file/' . $pengeluaran->file);

            // Periksa apakah file lama ada di folder
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath); // Hapus file lama
            }

            // Upload file baru
            $file = $request->file('file');
            $destinationPath = 'assets/images/file';
            $myfile = $file->getClientOriginalName();
            $file->move(public_path($destinationPath), $myfile);

            $pengeluaran->file = $myfile;
        }

        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->kode_akun = $request->kode_akun;
        $pengeluaran->jenis_akun = $request->jenis_akun;
        $pengeluaran->kategori_id = $request->kategori_id;
        $pengeluaran->uraian = $request->uraian;
        $pengeluaran->penerima = $request->penerima;
        $pengeluaran->jumlah = $request->jumlah;
        $pengeluaran->spj = $request->spj;
        $pengeluaran->tdspj = $request->tdspj;
        $pengeluaran->save();

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
        DB::table('pengeluarans')->where('id_pengeluaran', $id)->delete();
        return redirect()->route('pengeluaran.index')->with('info', 'Data Berhasil Dihapus!');
    }
}
