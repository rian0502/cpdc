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
        //
        Schema::create('litabmas_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('nama_litabmas');
            $table->enum('kategori', ['Penelitian', 'Pengabdian']);
            $table->string('sumber_dana');
            $table->string('jumlah_dana');
            $table->integer('tahun_penelitian');
            $table->text('anggota_external')->nullable();
            $table->text('anggota_mahasiswa')->nullable();
            $table->string('url')->nullable();
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
        //
        Schema::dropIfExists('litabmas_dosen');
    }
};
