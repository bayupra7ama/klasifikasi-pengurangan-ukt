<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PengajuanKeringanan;

class PredictController extends Controller
{
    public function index()
    {
        return view('prediksi');
    }

    public function predict(Request $request)
    {
        // VALIDASI INPUT
        $input = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'prodi' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',

            'penghasilan' => 'required|numeric',
            'tanggungan' => 'required|numeric',
            'pekerjaan' => 'required|string',
            'status_anak' => 'required|string',
            'tempat_tinggal' => 'required|string',
            'dtks' => 'required|numeric',
            'sktm' => 'required|numeric',
        ]);

        // DATA UNTUK API R
        $api_input = [
            'penghasilan' => $input['penghasilan'],
            'tanggungan' => $input['tanggungan'],
            'pekerjaan' => $input['pekerjaan'],
            'status_anak' => $input['status_anak'],
            'tempat_tinggal' => $input['tempat_tinggal'],
            'dtks' => $input['dtks'],
            'sktm' => $input['sktm'],
        ];

        // KIRIM KE API R
        $response = Http::post('http://127.0.0.1:5000/predict', $api_input);

        if ($response->failed()) {
            return back()->with('error', 'Gagal memproses prediksi');
        }

        $result = $response->json();

        // MAPPING HASIL
        $predicted_raw = $result['predicted'][0] ?? null;

        $status = $predicted_raw == '1' ? 'layak' : 'tidak layak';

        $prob = $result['probabilities'];

        $layak = isset($prob["1"][0]) ? round($prob["1"][0] * 100, 2) : 0;
        $tidakLayak = isset($prob["0"][0]) ? round($prob["0"][0] * 100, 2) : 0;

        // SIMPAN KE DATABASE
        PengajuanKeringanan::create([
            'nama' => $input['nama'],
            'nim' => $input['nim'],
            'prodi' => $input['prodi'],
            'jurusan' => $input['jurusan'],

            'penghasilan' => $input['penghasilan'],
            'tanggungan' => $input['tanggungan'],
            'pekerjaan' => $input['pekerjaan'],
            'status_anak' => $input['status_anak'],
            'tempat_tinggal' => $input['tempat_tinggal'],
            'dtks' => $input['dtks'],
            'sktm' => $input['sktm'],

            'hasil_prediksi' => $status,
            'probability_layak' => $layak,
            'probability_tidak_layak' => $tidakLayak,
        ]);

        return view('prediksi', [
            'result' => $result,
            'input' => $input,
            'predicted' => $status,
            'layak' => $layak,
            'tidakLayak' => $tidakLayak
        ]);
    }
}
