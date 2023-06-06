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
        Schema::create('anggota_publikasi', function (Blueprint $table) {
            $table->id();
            $table->enum('posisi', ['Ketua', 'Anggota']);
            $table->foreignId('id_dosen')->index()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_publikasi')->index()->constrained('publikasi')->onDelete('cascade')->onUpdate('cascade');
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
    }
};
