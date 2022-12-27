<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kd_buku', 12);
            $table->string('nama_buku', 70);
            $table->string('deskripsi', 100);
            $table->string('penulis', 70);
            $table->string('penerbit')->nullable();
            $table->string('tahun_terbit', 20);
            $table->integer('jml_buku');
            $table->string('jml_dipinjam', 20)->default(0);
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
        Schema::dropIfExists('bukus');
    }
}
