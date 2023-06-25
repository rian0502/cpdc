<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaSeminarKomprehensif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_seminar_komprehensif', function(Blueprint $table){
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('ba_seminar_komprehensif');
            $table->string('no_ba_berkas');
            $table->string('berkas_nilai_kompre');
            $table->string('laporan_ta');
            $table->string('nilai');
            $table->string('huruf_mutu');
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
        Schema::dropIfExists('ba_seminar_komprehensif');
    }
}
