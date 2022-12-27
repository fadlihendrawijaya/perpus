<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kd_anggota', 15);
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('nama_anggota', 70);
            $table->enum('jenis_anggota', ['siswa', 'guru', 'staf']);
            $table->enum('jk_anggota',['L', 'P'])->nunllable();
            $table->string('tempat_lahir', 50);
            $table->date('tgl_lahir');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('alamat', 100);
            $table->rememberToken();
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
        Schema::dropIfExists('anggotas');
    }
}
