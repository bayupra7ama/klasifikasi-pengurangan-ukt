<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // I. Data Diri (sesuaikan dengan yg diperlukan)
            $table->string('nama_mahasiswa')->nullable();
            $table->string('nim')->nullable();
            $table->string('prodi')->nullable();
            $table->string('jurusan')->nullable();

            // II. Keluarga
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('bekerja_sebagai_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('bekerja_sebagai_ibu')->nullable();
            $table->integer('jumlah_tanggungan')->nullable();
            $table->string('hp_orangtua')->nullable();
            $table->string('status_orangtua')->nullable();
            $table->string('pendidikan_orangtua')->nullable();
            $table->string('orangtua_kandung')->nullable();

            // III. Rumah tinggal keluarga
            $table->string('kepemilikan_rumah')->nullable();
            $table->string('tahun_perolehan')->nullable();
            $table->string('sumber_listrik')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('luas_bangunan')->nullable();
            $table->string('mandi_cuci_kakus')->nullable();
            $table->string('sumber_air')->nullable();
            $table->string('jarak_dari_kota')->nullable();
            $table->integer('jumlah_orang_tinggal')->nullable();

            // IV. Ekonomi keluarga
            $table->bigInteger('penghasilan_ayah')->nullable();
            $table->bigInteger('penghasilan_ibu')->nullable();
            $table->bigInteger('hutang')->nullable();
            $table->bigInteger('cicilan_per_bulan')->nullable();
            $table->bigInteger('piutang')->nullable();
            $table->bigInteger('tabungan')->nullable();

            // V. Kekayaan lain
            $table->integer('sepeda_motor')->nullable();
            $table->integer('mobil')->nullable();
            $table->decimal('kebun_hektar', 8, 2)->nullable();

            // meta
            $table->string('status')->default('Terkirim'); // baru/proses/disetujui/ditolak
            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuans');
    }
};
