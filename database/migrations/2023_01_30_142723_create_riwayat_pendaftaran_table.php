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
        Schema::create('riwayat_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_riwayat');
            $table->integer('id_pendaftaran');
            $table->integer('id_dokter');
            $table->integer('id_poli');
            $table->integer('id_jadwal');
            $table->integer('id_periksa');
            $table->integer('id_resep');
            $table->integer('id_pembayaran');
            $table->integer('id_laporan');
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
        Schema::dropIfExists('riwayat_pendaftaran');
    }
};
