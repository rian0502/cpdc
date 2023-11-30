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
        Schema::create('history_jabatan_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('encrypted_id')->nullable();
            $table->enum('jabatan', ['Tenaga Pengajar', 'Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar']);
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
        Schema::dropIfExists('history_jabatan_dosen');
    }
};
