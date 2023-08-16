<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class S2TugasAkhirKompre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('s2_kompre', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('tahun_akademik');
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->string('periode_seminar');
            $table->string('judul_ta');
            $table->string('sks');
            $table->string('ipk');
            $table->string('toefl');
            $table->string('berkas_kompre');
            $table->boolean('agreement');
            $table->string('komentar')->nullable();
            $table->enum('status_admin', ['Valid', 'Invalid', 'Process'])->default('Process');
            $table->enum('status_koor', ['Selesai', 'Belum Selesai', 'Perbaikan', 'Tidak Lulus'])->default('Belum Selesai');
            $table->foreignId('id_pembimbing_1')->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pembimbing_2')->nullable()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pbl2_nama')->nullable();
            $table->string('pbl2_nip')->nullable();
            $table->string('draft_artikel');
            $table->string('url_draft_artikel');
            $table->foreignId('id_pembahas_1')->nullable()->index()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pembahas_2')->nullable()->index()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pembahas_3')->nullable()->index()->constrained('dosen')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pembahas_external_1')->nullable();
            $table->string('nip_pembahas_external_1')->nullable();
            $table->string('pembahas_external_2')->nullable();
            $table->string('nip_pembahas_external_2')->nullable();
            $table->string('pembahas_external_3')->nullable();
            $table->string('nip_pembahas_external_3')->nullable();
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
        Schema::dropIfExists('s2_kompre');
    }
}
