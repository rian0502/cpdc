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
        Schema::create('publikasi', function (Blueprint $table) {
            $table->id();
            $table->string('encrypt_id')->nullable();
            $table->string('nama_publikasi');
            $table->string('judul');
            $table->string('tahun');
            $table->integer('vol')->nullable();
            $table->string('halaman')->nullable();
            $table->enum('scala', ['Nasional', 'Internasional']);
            $table->enum('kategori', [
                'Buku Referensi', 
                'Monograf', 
                'Buku Nasional', 
                'Buku Internasional', 
                'Artikel Internasional Bereputasi',
                'Artikel Internasional Terindkes',
                'Jurnal Nasional Terakreditasi Dikti',
                'Jurnal Nasional',
                'Jurnal Ilmiah',
                'Prosiding Internasional Terindeks',
                'Prosiding Internasional',
                'Prosiding Nasional',
                'Paten',
                'Paten Sederhana',
                'Hak Cipta',
                'Desain Produk Industri',
                'Teknologi Tepat Guna',
                'Buku ber-ISBN',
                'Book Chapter'
            ]);
            $table->enum('kategori_litabmas', ['Penelitian', 'Pengabdian']);
            $table->string('url')->nullable();
            $table->text('anggota_external')->nullable();
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
        Schema::dropIfExists('publikasi');
    }
};
