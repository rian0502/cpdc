<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaS2SeminarKompre extends Migration
{
    public function up()
    {
        //
        Schema::create('ba_s2_kompre', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->unique()->nullable();
            $table->string('no_ba');
            $table->double('nilai');
            $table->string('nilai_mutu', 2);
            $table->string('pengesahan');
            $table->string('file_ba');
            $table->string('file_nilai');
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
        Schema::dropIfExists('ba_s2_kompre');
    }
}
