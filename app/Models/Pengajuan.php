<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_mahasiswa',
        'nim',
        'prodi',
        'jurusan',
        'nama_ayah',
        'pekerjaan_ayah',
        'bekerja_sebagai_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'bekerja_sebagai_ibu',
        'jumlah_tanggungan',
        'hp_orangtua',
        'status_orangtua',
        'pendidikan_orangtua',
        'orangtua_kandung',
        'kepemilikan_rumah',
        'tahun_perolehan',
        'sumber_listrik',
        'luas_tanah',
        'luas_bangunan',
        'mandi_cuci_kakus',
        'sumber_air',
        'jarak_dari_kota',
        'jumlah_orang_tinggal',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'hutang',
        'cicilan_per_bulan',
        'piutang',
        'tabungan',
        'mobil',
        'sepeda_motor',
        'kebun_hektar',
        'status',
        'catatan_admin',
        'pesan'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
