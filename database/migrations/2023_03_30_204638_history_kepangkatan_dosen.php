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
        //'
        Schema::create('history_kepangkatan_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('encrypted_id')->nullable();
            $table->enum('kepangkatan', [
                'III A',
                'III B',
                'III C',
                'IV A',
                'IV B',
                'IV C',
                'IV D',
                'IV E',
            ]);
            $table->date('tgl_sk');
            $table->string('file_sk');
            $table->foreignId('dosen_id')->index()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('history_kepangkatan_dosen');
    }
};
