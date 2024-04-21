<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengeluaran';
    protected $table = 'pengeluarans';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    public function jenisAkun()
    {
        return $this->belongsTo(JenisAkun::class, 'jenis_akun_id', 'id_jenis_akun');
    }



    

}
