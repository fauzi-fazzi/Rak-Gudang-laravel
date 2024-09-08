<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('image')->nullable();
            $table->string('kode');
            $table->foreignId('vendor_id')->constrained('vendor');
            $table->foreignId('rak_id')->constrained('rak');
            $table->foreignId('kategori_id')->constrained('kategori');
            $table->string('gramasi');
            $table->bigInteger('stok')->nullable();
            $table->foreignId('satuan_id')->constrained('satuan');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('barang');
    }
}
