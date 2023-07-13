<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PendataanAlumni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pendataam_alumni', function(Blueprint $table){
            $table->id();
            $table->string('encrypted_id')->nullable()->unique();
            $table->string('tahun_akademik');
            $table->string('sks');
            $table->string('ipk');
            $table->date('tgl_lulus');
            $table->string('masa_studi');
            $table->string('periode_wisuda');
            $table->string('toefl');
            $table->string('berkas_pengesahan');
            $table->string('transkrip');
            $table->string('berkas_toefl');
            $table->enum('status', ['Valid', 'Invalid', 'Pending'])->default('Pending');
            $table->string('komentar')->nullable();
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
        Schema::dropIfExists('pendataam_alumni');
    }
}
