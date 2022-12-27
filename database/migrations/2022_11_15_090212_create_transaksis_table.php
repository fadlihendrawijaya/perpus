<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kd_peminjam', 20);
            $table->integer('anggota_id');
            $table->integer('buku_id');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->enum('status', ['proses', 'pinjam', 'kembali', 'hilang', 'rusak', 'tolak']);
            $table->string('status_denda')->nullable();
            $table->string('denda')->nullable();
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
        Schema::dropIfExists('transaksis');
    }
}
