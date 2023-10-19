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
        Schema::create('anggota_litabmas_dosen', function (Blueprint $table) {
            $table->id();
            $table->enum('Posisi', ['Ketua', 'Anggota']);
            $table->foreignId('dosen_id')->index()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('litabmas_id')->index()->constrained('litabmas_dosen')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('anggota_litabmas_dosen');
    }
};
