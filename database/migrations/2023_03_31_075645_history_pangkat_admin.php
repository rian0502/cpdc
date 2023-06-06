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
        Schema::create('history_pangkat_admin', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->enum('pangkat', ['I a', 'I b', 'I c', 'I d', 'II a', 'II b', 'II c', 'II d', 'III a', 'III b', 'III c', 'III d', 'IV a', 'IV b', 'IV c', 'IV d', 'IV e']);
            $table->date('tgl_sk');
            $table->string('file_sk');
            $table->foreignId('administrasi_id')->index()->constrained('administrasi')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('history_pangkat_admin');
    }
};
