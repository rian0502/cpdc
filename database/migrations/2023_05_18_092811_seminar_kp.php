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
        Schema::create('seminar_kp', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('judul_kp');
            $table->enum('semester',['Ganjil', 'Genap']);
            $table->string('tahun_akademik');
            $table->string('mitra');
            $table->enum('region', ['Unila', 'Dalam Lampung', 'Luar Lampung']);
            $table->string('rencana_seminar');
            $table->string('pembimbing_lapangan');
            $table->string('ni_pemlap');
            $table->integer('toefl')->nullable();
            $table->integer('sks');
            $table->double('ipk');
            $table->string('berkas_seminar_pkl');
            $table->boolean('agreement');
            $table->enum('status_seminar', ['Selesai', 'Belum Selesai', 'Perbaikan', 'Tidak Lulus']);
            $table->enum('proses_admin',['Proses', 'Valid', 'Invalid']);
            $table->string('keterangan')->nullable();
            $table->foreignId('id_dospemkp')->index()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_mahasiswa')->index()->constrained('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
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
            Schema::dropIfExists('seminar_kp');
    }
};
