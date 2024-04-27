<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_saldo';
    protected $table = 'saldos';
    protected $guarded = [];
}
