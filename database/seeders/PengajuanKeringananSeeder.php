<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengajuanKeringanan;
use Carbon\Carbon;

class PengajuanKeringananSeeder extends Seeder
{
    public function run(): void
    {
        $pekerjaan = [
            "buruh",
            "buruh harian lepas",
            "guru",
            "irt",
            "karyawan",
            "karyawan swasta",
            "ketua rw",
            "kuli bangunan",
            "mekanik",
            "nelayan",
            "petani",
            "asn",
            "pns",
            "tni/polri",
            "pegawai swasta",
            "wiraswasta",
            "ojek"
        ];

        $statusAnak = ["lengkap", "cerai", "yatim", "piatu", "yatim piatu"];

        $rumah = ["layak", "kurang layak", "tidak layak"];

        $prodi = [
            "Teknik Informatika",
            "Sistem Informasi",
            "Manajemen",
            "Akuntansi",
            "Ilmu Hukum",
            "PGSD",
            "Teknik Elektro",
            "Teknik Mesin"
        ];

        $jurusan = [
            "Fakultas Teknik",
            "Fakultas Ekonomi",
            "Fakultas Hukum",
            "Fakultas Keguruan"
        ];

        for ($i = 1; $i <= 120; $i++) {

            $penghasilan = fake()->numberBetween(500000, 5000000);

            // generate hasil prediksi otomatis berdasarkan penghasilan
            $hasil = $penghasilan <= 2500000 ? "layak" : "tidak layak";

            PengajuanKeringanan::create([
                'nama' => fake()->name(),
                'nim' => "22" . fake()->numberBetween(10000, 99999),
                'prodi' => fake()->randomElement($prodi),
                'jurusan' => fake()->randomElement($jurusan),

                'penghasilan' => $penghasilan,
                'tanggungan' => fake()->numberBetween(1, 6),
                'pekerjaan' => fake()->randomElement($pekerjaan),
                'status_anak' => fake()->randomElement($statusAnak),
                'tempat_tinggal' => fake()->randomElement($rumah),
                'dtks' => fake()->boolean(40), // 40% punya DTKS
                'sktm' => fake()->boolean(30), // 30% punya SKTM

                'hasil_prediksi' => $hasil,
                'probability_layak' => fake()->numberBetween(40, 95),
                'probability_tidak_layak' => fake()->numberBetween(10, 90),

                // tanggal random 12 bulan terakhir
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
            ]);
        }
    }
}
