<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_keringanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('prodi');
            $table->string('jurusan');

            $table->bigInteger('penghasilan');
            $table->integer('tanggungan');
            $table->string('pekerjaan');
            $table->string('status_anak');
            $table->string('tempat_tinggal');
            $table->boolean('dtks');
            $table->boolean('sktm');

            $table->string('hasil_prediksi'); // "layak" / "tidak layak"
            $table->decimal('probability_layak', 6, 2);
            $table->decimal('probability_tidak_layak', 6, 2);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_keringanans');
    }
};
