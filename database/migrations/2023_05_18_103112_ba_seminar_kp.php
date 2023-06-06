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
        Schema::create('ba_seminar_kp', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('no_ba_seminar_kp');
            $table->double('nilai_lapangan');
            $table->double('nilai_akd');
            $table->double('nilai_akhir');
            $table->char('nilai_mutu', 2);
            $table->string('berkas_ba_seminar_kp');
            $table->string('laporan_kp')->nullable();
            $table->foreignId('id_seminar')->index()->constrained('seminar_kp')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ba_seminar_kp');
    }
};
