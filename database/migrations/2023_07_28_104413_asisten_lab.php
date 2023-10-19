<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsistenLab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('asisten_lab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_actity_lab')->constrained('activity_lab')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('asisten_lab');

    }
}
