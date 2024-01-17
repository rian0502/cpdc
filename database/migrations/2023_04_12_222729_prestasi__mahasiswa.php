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
        Schema::create('prestasi_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('nama_prestasi');
            $table->enum('scala', ['Nasional', 'Internasional', 'Provinsi', 'Kabupaten/Kota', 'Universitas']);
            $table->enum('capaian', ['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2', 'Harapan 3', 'Peserta']);
            $table->enum('jenis', ['Akademik', 'Non Akademik']);
            $table->bigInteger('id_pembimbing')->nullable();
            $table->string('nama_pembimbing')->nullable();
            $table->string('nip_pembimbing')->nullable();
            $table->date('tanggal');
            $table->string('file_prestasi');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('prestasi_mahasiswa');
    }
};
