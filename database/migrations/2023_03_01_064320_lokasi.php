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
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->unique()->nullable();
            $table->string('nama_lokasi');
            $table->string('lantai_tingkat');
            $table->string('nama_gedung');
            $table->enum('jenis_ruangan', ['Kelas', 'Lab']);
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
        Schema::dropIfExists('lokasi');
    }
};
