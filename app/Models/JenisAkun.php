<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAkun extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenis_akun';
    protected $table = 'jenis_akuns';
    protected $guarded = [];


    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}


