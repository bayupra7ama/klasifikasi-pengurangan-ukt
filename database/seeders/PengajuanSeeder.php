<?php

namespace Database\Seeders;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class PengajuanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Batas bulan seed (Januari -> Oktober 2025)
        $startMonth = 1;
        $endMonth = 10;
        $year = 2025;

        // Ambil user random untuk relasi user_id
        $userIds = User::pluck('id')->toArray();

        for ($month = $startMonth; $month <= $endMonth; $month++) {

            // jumlah pengajuan per bulan (acak)
            $jumlah = rand(10, 25);

            for ($i = 0; $i < $jumlah; $i++) {

                $tanggal = Carbon::create($year, $month, rand(1, 28), rand(8, 17), rand(0, 59));

                Pengajuan::create([

                    'user_id' => $faker->randomElement($userIds),
                    'nama_mahasiswa' => $faker->name,
                    'nim' => '43' . rand(100000, 999999),
                    'jurusan' => $faker->randomElement([
                        'Teknik Informatika',
                        'Teknik Elektro',
                        'Teknik Sipil',
                        'Administrasi Niaga',
                        'Teknik Perkapalan'
                    ]),
                    'prodi' => $faker->randomElement([
                        'D4 Rekayasa Perangkat Lunak',
                        'D3 Teknik Elektro',
                        'D3 Teknik Sipil',
                        'D3 Administrasi Bisnis'
                    ]),

                    // keluarga
                    'nama_ayah' => $faker->name('male'),
                    'pekerjaan_ayah' => $faker->randomElement(['Buruh', 'Petani', 'Wiraswasta', 'ASN']),
                    'bekerja_sebagai_ayah' => $faker->sentence(3),
                    'nama_ibu' => $faker->name('female'),
                    'pekerjaan_ibu' => $faker->randomElement(['IRT', 'Guru', 'Wiraswasta']),
                    'bekerja_sebagai_ibu' => $faker->sentence(3),
                    'jumlah_tanggungan' => rand(1, 6),
                    'hp_orangtua' => $faker->phoneNumber,
                    'status_orangtua' => $faker->randomElement(['Kandung', 'Tiri', 'Angkat']),
                    'pendidikan_orangtua' => $faker->randomElement(['SD', 'SMP', 'SMA', 'S1']),
                    'orangtua_kandung' => $faker->randomElement(['Masih Hidup', 'Sudah Wafat']),

                    // rumah
                    'kepemilikan_rumah' => $faker->randomElement(['Sendiri', 'Sewa', 'Menumpang']),
                    'tahun_perolehan' => rand(2000, 2024),
                    'sumber_listrik' => $faker->randomElement(['PLN', 'Genset', 'Tenaga Surya']),
                    'luas_tanah' => $faker->randomElement(['>200 m2', '100-200 m2', '50-99 m2']),
                    'luas_bangunan' => $faker->randomElement(['>200 m2', '100-200 m2', '50-99 m2']),
                    'mandi_cuci_kakus' => $faker->randomElement(['Dalam', 'Luar', 'Berbagi']),
                    'sumber_air' => $faker->randomElement(['PDAM', 'Sumur', 'Air Kemasan']),
                    'jarak_dari_kota' => rand(1, 40),
                    'jumlah_orang_tinggal' => rand(2, 8),

                    // ekonomi
                    'penghasilan_ayah' => rand(500000, 7000000),
                    'penghasilan_ibu' => rand(300000, 5000000),
                    'hutang' => rand(0, 20000000),
                    'cicilan_per_bulan' => rand(0, 2000000),
                    'piutang' => rand(0, 5000000),
                    'tabungan' => rand(0, 10000000),

                    // kekayaan
                    'sepeda_motor' => rand(0, 3),
                    'mobil' => rand(0, 2),
                    'kebun_hektar' => rand(0, 3),

                    // status
                    'status' => $faker->randomElement([
                        'Terkirim',
                        'Ditinjau',
                        'Tahap Wawancara',
                        'Disetujui',
                        'Ditolak'
                    ]),
                    'catatan_admin' => $faker->sentence(),

                    'created_at' => $tanggal,
                    'updated_at' => $tanggal,
                ]);
            }
        }

        echo "Seeder pengajuan selesai!\n";
    }
}
