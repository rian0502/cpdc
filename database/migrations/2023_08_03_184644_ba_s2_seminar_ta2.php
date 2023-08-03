<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaS2SeminarTa2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ba_s2_seminar_ta2', function(Blueprint $table){
            $table->id();
            $table->string('encrypt_id')->unique()->nullable();
            $table->string('no_ba');
            $table->double('nilai');
            $table->string('nilai_mutu', 2);
            $table->string('ppt');
            $table->string('file_ba');
            $table->string('file_nilai');
            $table->foreignId('id_seminar')->constrained('s2_tugas_akhir_2')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists ('ba_s2_seminar_ta2');
    }
}
