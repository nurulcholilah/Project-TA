<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->id('id_pemasukan');
            $table->date('tanggal');
            $table->string('uraian');
            $table->string('kode');
            $table->enum('keterangan', ['SPJ', 'Tidak SPJ'])->nullable();
            $table->string('jum_spj');
            $table->string('jum_tspj');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukans');
    }
};
