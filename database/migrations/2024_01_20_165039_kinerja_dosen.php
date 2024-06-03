<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KinerjaDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('kinerja_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('encrypted_id')->nullable();
            $table->enum('kategori', ['BKD', 'Remunerasi']);
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('tahun_akademik');
            $table->integer('sks_pendidikan');
            $table->integer('sks_penelitian');
            $table->integer('sks_pengabdian');
            $table->integer('sks_penunjang');
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('kinerja_dosen');
    }
}
