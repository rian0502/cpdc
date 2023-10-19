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
        Schema::create('history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('encrypt_id')->unique()->nullable();
            $table->bigInteger('jumlah_awal')->unsigned();
            $table->string('ket');
            $table->foreignId('id_barang')->index()->constrained('barang')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('history');
    }
};
