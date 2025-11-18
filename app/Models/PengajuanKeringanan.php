<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanKeringanan extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'jurusan',
        'penghasilan',
        'tanggungan',
        'pekerjaan',
        'status_anak',
        'tempat_tinggal',
        'dtks',
        'sktm',
        'hasil_prediksi',
        'probability_layak',
        'probability_tidak_layak'
    ];
}
