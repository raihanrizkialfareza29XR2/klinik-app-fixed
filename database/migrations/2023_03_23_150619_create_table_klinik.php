<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('klinik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_klinik');
            $table->string('alamat_klinik');
            $table->string('kota');
            $table->string('tlp_klinik');
            $table->string('fax_klinik');
            $table->string('logo');
            $table->integer('biaya_admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_klinik');
    }
};
