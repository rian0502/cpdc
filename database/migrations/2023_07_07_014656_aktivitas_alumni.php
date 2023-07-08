<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AktivitasAlumni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('aktivitas_alumni', function(Blueprint $table){
            $table->id();
            $table->string('encrypted_id');
            $table->string('tempat');
            $table->string('alamat');
            $table->string('jabatan');
            $table->string('tahun_masuk');
            $table->enum('hubungan', ['Sangat Erat', 'Cukup Erat', 'Tidak Erat', 'Erat']);
            $table->double('gaji');
            $table->enum('status', ['Kerja', 'Kuliah', 'Wirausaha', 'Lainnya']);
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
        Schema::dropIfExists('aktivitas_alumni');
    }
}
