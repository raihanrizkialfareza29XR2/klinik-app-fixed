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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pendaftaran');
            $table->string('id_pembayaran');
            $table->string('biaya_dokter');
            $table->string('biaya_obat');
            $table->string('biaya_admin');
            $table->integer('id_resep');
            $table->integer('total_biaya');
            $table->integer('total_bayar');
            $table->integer('kembalian');
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
        Schema::dropIfExists('pembayaran');
    }
};
