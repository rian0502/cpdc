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
        Schema::create('aktivitas_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('nama_aktivitas');
            $table->enum('peran', ['Ketua', 'Anggota', 'Peserta']);
            $table->enum('skala', ['Universitas', 'Regional', 'Nasional', 'Internasional']);
            $table->string('sks_konversi');
            $table->date('tanggal');
            $table->string('file_aktivitas');
            $table->enum('jenis', ['MBKM', 'PKM', 'HIMA', 'UKM', 'Lainnya']);
            $table->string('kategori');
            $table->string('nama_pembimbing')->nullable();
            $table->string('nip_pembimbing')->nullable();
            $table->foreignId('mahasiswa_id')->index()->constrained('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pembimbing')->nullable()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('aktivitas_mahasiswa');
    }
};
