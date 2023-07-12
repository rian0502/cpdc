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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('nip');
            $table->string('nidn');
            $table->string('nama_dosen');
            $table->string('no_hp');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('alamat');
            $table->enum('status', ['Aktif', 'Pensiun']);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->foreignId('user_id')->index()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('dosen');
    }
};
