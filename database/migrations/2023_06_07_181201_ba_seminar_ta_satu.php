<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaSeminarTaSatu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ba_seminar_ta_satu', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('no_berkas_ba_seminar_ta_satu');
            $table->string('berkas_ba_seminar_ta_satu');
            $table->string('berkas_nilai_seminar_ta_satu');
            $table->string('berkas_ppt_seminar_ta_satu');
            $table->double('nilai');
            $table->string('huruf_mutu');
            $table->foreignId('id_seminar')->constrained('seminar_ta_satu')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ba_seminar_ta_satu');
    }
}
