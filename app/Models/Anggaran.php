<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_anggaran';
    protected $table = 'anggarans';
    protected $guarded = [];
}
