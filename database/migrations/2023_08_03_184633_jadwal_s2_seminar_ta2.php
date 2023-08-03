<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalS2SeminarTa2 extends Migration
{
    public function up()
    {
        //
        Schema::create('jadwal_s2_seminar_ta2', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->unique()->nullable();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->foreignId('id_lokasi')->index()->constrained('lokasi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_seminar')->constrained('s2_tugas_akhir_2')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('jadwal_s2_seminar_ta2');
    }
}
