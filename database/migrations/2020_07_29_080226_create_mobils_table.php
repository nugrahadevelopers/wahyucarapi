<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('photo_mobil')->default('');
            $table->string('nama_mobil');
            $table->decimal('harga_mobil', 12, 2);
            $table->string('tipe_mobil');
            $table->string('merek_mobil');
            $table->string('varian_mobil');
            $table->string('tahun_mobil');
            $table->string('mesin_mobil');
            $table->string('warna_mobil');
            $table->string('kapasitas_mobil');
            $table->string('user_id');
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
        Schema::dropIfExists('mobils');
    }
}
