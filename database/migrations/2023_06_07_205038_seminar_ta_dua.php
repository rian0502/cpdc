<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeminarTaDua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seminar_ta_dua', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('tahun_akademik');
            $table->enum('semester',['Ganjil', 'Genap']);
            $table->string('periode_seminar');
            $table->string('judul_ta');
            $table->string('sks');
            $table->string('ipk');
            $table->string('toefl');
            $table->string('berkas_ta_dua');
            $table->string('komentar')->nullable();
            $table->boolean('agreement');
            $table->enum('status_admin', ['Valid', 'Invalid', 'Process'])->default('Process');
            $table->enum('status_koor', ['Selesai', 'Belum Selesai', 'Perbaikan', 'Tidak Lulus'])->default('Belum Selesai');
            $table->foreignId('id_pembimbing_satu')->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pembimbing_dua')->nullable()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pbl2_nama')->nullable();
            $table->string('pbl2_nip')->nullable();
            $table->foreignId('id_pembahas')->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('seminar_ta_dua');
    }
}
