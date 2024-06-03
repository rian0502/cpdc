<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PenghargaanDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('penghargaan_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('nama');
            $table->date('tanggal');
            $table->enum('scala', ['Nasional', 'Internasional', 'Provinsi', 'Kabupaten/Kota', 'Universitas']);
            $table->text('uraian');
            $table->string('url');
            $table->enum('kategori', ['Satya Lencana', 'Sertifikat Kopetensi', 'Piagam Penghargaan', 'Narasumber', 'Staff Ahli', 'Tenaga Ahli/Konsultan', 'Keynote Speaker', 'Invited Speaker', 'Visiting Lecturer', 'Visiting Researcher', 'Editor/Mitra Bestari']);
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
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
    }
}
