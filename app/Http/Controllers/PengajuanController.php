<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{

    public function create()
    {
        // Hanya return view pengajuan
        return view('pengajuan.create');
    }


    /**
     * Simpan pengajuan mahasiswa
     */
    public function store(Request $request)
    {
        // ===============================
        // 1. VALIDASI DATA
        // ===============================
        $request->validate([
            'nim' => 'required|string|max:50',
            'jurusan' => 'required|string',
            'prodi' => 'required|string',

            // Keluarga
            'nama_ayah' => 'nullable|string',
            'pekerjaan_ayah' => 'nullable|string',
            'bekerja_sebagai_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'pekerjaan_ibu' => 'nullable|string',
            'bekerja_sebagai_ibu' => 'nullable|string',
            'jumlah_tanggungan' => 'nullable|numeric',
            'hp_orangtua' => 'nullable|string',
            'status_orangtua' => 'nullable|string',
            'pendidikan_orangtua' => 'nullable|string',

            // Rumah
            'kepemilikan_rumah' => 'nullable|string',
            'tahun_perolehan' => 'nullable|string',
            'sumber_listrik' => 'nullable|string',
            'luas_tanah' => 'nullable|string',
            'luas_bangunan' => 'nullable|string',
            'mandi_cuci_kakus' => 'nullable|string',
            'sumber_air' => 'nullable|string',

            // Ekonomi
            'penghasilan_ayah' => 'nullable|string',
            'penghasilan_ibu' => 'nullable|string',
            'hutang' => 'nullable|string',
            'cicilan_perbulan' => 'nullable|string',
            'piutang' => 'nullable|string',
            'tabungan' => 'nullable|string',

            // Kekayaan
            'motor' => 'nullable|numeric',
            'mobil' => 'nullable|numeric',
            'kebun' => 'nullable|numeric',
        ]);

        // ===============================
        // 2. KONVERSI RUPIAH KE ANGKA
        // ===============================
        $rupiahFields = [
            'penghasilan_ayah',
            'penghasilan_ibu',
            'hutang',
            'cicilan_perbulan',
            'piutang',
            'tabungan'
        ];

        $cleaned = $request->all();

        foreach ($rupiahFields as $field) {
            if (!empty($cleaned[$field])) {
                $cleaned[$field] = preg_replace('/[^0-9]/', '', $cleaned[$field]);
            }
        }

        // Tambahkan ID user
        $cleaned['user_id'] = auth()->id();

        // ===============================
        // 3. SIMPAN KE DATABASE
        // ===============================
        Pengajuan::create($cleaned);

        // ===============================
        // 4. REDIRECT
        // ===============================
        return redirect()->route('pengajuan.success');

    }

    public function riwayat()
    {
        $pengajuan = Pengajuan::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengajuan.riwayat', compact('pengajuan'));
    }

    public function riwayatAdmin(Request $request)
    {
        $query = Pengajuan::with('user')->orderBy('created_at', 'desc');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->q) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('nim', 'like', '%' . $request->q . '%');
            });
        }

        $pengajuan = $query->paginate(10);

        return view('admin.pengajuan.riwayat', compact('pengajuan'));
    }


    public function detail($id)
    {
        $pengajuan = Pengajuan::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('pengajuan.detail', compact('pengajuan'));
    }

    public function showAdmin($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);

        return view('admin.pengajuan.detail', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Terkirim,Ditinjau,Tahap Wawancara,Disetujui,Ditolak',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

        return back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

}
