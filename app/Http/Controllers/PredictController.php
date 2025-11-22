<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictController extends Controller
{
    public function index()
    {
        return view('prediksi');
    }

    public function predict(Request $request)
    {
        // terima penghasilan sebagai string karena di-form ada format rupiah
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'prodi' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',

            'penghasilan' => 'required|string', // terima dulu string
            'tanggungan' => 'required|numeric',
            'pekerjaan' => 'required|string',
            'status_anak' => 'required|string',
            'tempat_tinggal' => 'required|string',
            'dtks' => 'required|numeric',
            'sktm' => 'required|numeric',
        ]);

        // bersihkan penghasilan -> angka murni (tanpa pemisah ribuan)
        $rawPenghasilan = $validated['penghasilan'];
        $cleanPenghasilan = (int) preg_replace('/\D/', '', (string) $rawPenghasilan);

        // siapkan data untuk API (sesuai yang model R butuhkan)
        $api_input = [
            'penghasilan' => $cleanPenghasilan,
            'tanggungan' => (int) $validated['tanggungan'],
            'pekerjaan' => $validated['pekerjaan'],
            'status_anak' => $validated['status_anak'],
            'tempat_tinggal' => $validated['tempat_tinggal'],
            'dtks' => (int) $validated['dtks'],
            'sktm' => (int) $validated['sktm'],
        ];

        // kirim ke API R
        $response = Http::post('http://127.0.0.1:5000/predict', $api_input);

        if ($response->failed()) {
            return back()->with('error', 'Gagal memproses prediksi');
        }

        $result = $response->json();

        // mapping hasil (tetap aman jika API berubah sedikit)
        $predicted_raw = $result['predicted'][0] ?? null;
        $status = $predicted_raw == '1' ? 'layak' : 'tidak layak';

        $prob = $result['probabilities'] ?? null;
        $layak = isset($prob["1"][0]) ? round($prob["1"][0] * 100, 2) : 0;
        $tidakLayak = isset($prob["0"][0]) ? round($prob["0"][0] * 100, 2) : 0;

        // siapkan input yang dikembalikan ke view (tampilkan penghasilan dengan format rupiah yang user lihat)
        $returnInput = [
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'prodi' => $validated['prodi'],
            'jurusan' => $validated['jurusan'],
            'penghasilan' => $cleanPenghasilan, // angka murni, blade bisa format ulang
            'penghasilan_raw' => $rawPenghasilan, // kalau mau tampil persis apa user ketik
            'tanggungan' => $validated['tanggungan'],
            'pekerjaan' => $validated['pekerjaan'],
            'status_anak' => $validated['status_anak'],
            'tempat_tinggal' => $validated['tempat_tinggal'],
            'dtks' => $validated['dtks'],
            'sktm' => $validated['sktm'],
        ];

        // TIDAK MENYIMPAN KE DATABASE — hanya tampilkan hasil
        return view('prediksi', [
            'result' => $result,
            'input' => $returnInput,
            'predicted' => $status,
            'layak' => $layak,
            'tidakLayak' => $tidakLayak
        ]);
    }
}
