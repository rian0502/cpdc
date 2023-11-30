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
        Schema::create('jadwal_skp', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->date('tanggal_skp');
            $table->string('jam_mulai_skp',5);
            $table->string('jam_selesai_skp',5);
            $table->foreignId('id_lokasi')->index()->constrained('lokasi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_skp')->index()->constrained('seminar_kp')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('jadwal_skp');
    }
};
