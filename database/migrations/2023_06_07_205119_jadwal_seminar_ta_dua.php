<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalSeminarTaDua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('jadwal_seminar_ta_dua', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->date('tanggal_seminar_ta_dua');
            $table->string('jam_mulai_seminar_ta_dua',5);
            $table->string('jam_selesai_seminar_ta_dua',5);
            $table->foreignId('id_lokasi')->index()->constrained('lokasi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_seminar')->constrained('seminar_ta_dua')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('jadwal_seminar_ta_dua');
    }
}
