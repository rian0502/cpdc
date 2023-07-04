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
        Schema::create('activity_lab', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('encrypted_id')->unique()->nullable();
            $table->string('nama_kegiatan');
            $table->foreignId('id_lokasi')->constrained('lokasi')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('keperluan', ['Praktikum', 'Seminar', 'Ujian', 'Penelitian', 'Lainnya']);
            $table->date('tanggal_kegiatan');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('keterangan');
            $table->integer('jumlah_mahasiswa');
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
        Schema::dropIfExists('activity_lab');
    }
};
