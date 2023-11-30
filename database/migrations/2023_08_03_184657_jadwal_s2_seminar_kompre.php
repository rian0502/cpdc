<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalS2SeminarKompre extends Migration
{
    public function up()
    {
        //
        Schema::create('jadwal_s2_kompre', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->unique()->nullable();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->foreignId('id_lokasi')->index()->constrained('lokasi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_seminar')->constrained('s2_kompre')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('jadwal_s2_kompre');
    }
}
