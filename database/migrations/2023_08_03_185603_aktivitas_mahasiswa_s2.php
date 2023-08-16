<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AktivitasMahasiswaS2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('aktivitas_mahasiswa_s2', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('nama_aktivitas');
            $table->enum('peran', ['Ketua', 'Anggota', 'Peserta']);
            $table->string('sks_konversi');
            $table->date('tanggal');
            $table->string('file_aktivitas');
            $table->enum('kategori', ['Internasional', 'Nasional']);
            $table->foreignId('mahasiswa_id')->index()->constrained('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('aktivitas_mahasiswa_s2');
    }
}
