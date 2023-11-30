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
            $table->enum('pangkat', ['I A', 'I B', 'I C', 'I D', 'II A', 'II B', 'II C', 'II D', 'III A', 'III B', 'III C', 'III D', 'IV A', 'IV B', 'IV C', 'IV d', 'IV E']);
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
