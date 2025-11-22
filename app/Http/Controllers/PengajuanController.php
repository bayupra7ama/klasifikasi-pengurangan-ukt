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
        $validated = $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'prodi' => 'required|string|max:150',

            // keluarga
            'nama_ayah' => 'nullable|string',
            'pekerjaan_ayah' => 'nullable|string',
            'bekerja_sebagai_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'pekerjaan_ibu' => 'nullable|string',
            'bekerja_sebagai_ibu' => 'nullable|string',
            'jumlah_tanggungan' => 'nullable|integer',
            'hp_orangtua' => 'nullable|string',
            'status_orangtua' => 'nullable|string',
            'pendidikan_orangtua' => 'nullable|string',
            'orangtua_kandung' => 'nullable|string',

            // rumah
            'kepemilikan_rumah' => 'nullable|string',
            'tahun_perolehan' => 'nullable|string',
            'sumber_listrik' => 'nullable|string',
            'luas_tanah' => 'nullable|string',
            'luas_bangunan' => 'nullable|string',
            'mandi_cuci_kakus' => 'nullable|string',
            'sumber_air' => 'nullable|string',
            'jarak_pusat_kota' => 'nullable|numeric',
            'jumlah_orang_tinggal' => 'nullable|integer',

            // ekonomi
            'penghasilan_ayah' => 'nullable|string',
            'penghasilan_ibu' => 'nullable|string',
            'hutang' => 'nullable|string',
            'cicilan_perbulan' => 'nullable|string',
            'piutang' => 'nullable|string',
            'tabungan' => 'nullable|string',

            // kekayaan
            'motor' => 'nullable|integer',
            'mobil' => 'nullable|integer',
            'kebun' => 'nullable|numeric'
        ]);

        // Bersihkan rupiah
        foreach (['penghasilan_ayah', 'penghasilan_ibu', 'hutang', 'cicilan_perbulan', 'piutang', 'tabungan'] as $f) {
            if (isset($validated[$f])) {
                $validated[$f] = (int) preg_replace('/\D/', '', $validated[$f]);
            }
        }

        // Mapping field dari Blade → database
        $data = [
            'user_id' => auth()->id(),
            'nama_mahasiswa' => $validated['nama_mahasiswa'],
            'nim' => $validated['nim'],
            'jurusan' => $validated['jurusan'],
            'prodi' => $validated['prodi'],

            'nama_ayah' => $validated['nama_ayah'] ?? null,
            'pekerjaan_ayah' => $validated['pekerjaan_ayah'] ?? null,
            'bekerja_sebagai_ayah' => $validated['bekerja_sebagai_ayah'] ?? null,
            'nama_ibu' => $validated['nama_ibu'] ?? null,
            'pekerjaan_ibu' => $validated['pekerjaan_ibu'] ?? null,
            'bekerja_sebagai_ibu' => $validated['bekerja_sebagai_ibu'] ?? null,
            'jumlah_tanggungan' => $validated['jumlah_tanggungan'] ?? null,
            'hp_orangtua' => $validated['hp_orangtua'] ?? null,
            'status_orangtua' => $validated['status_orangtua'] ?? null,
            'pendidikan_orangtua' => $validated['pendidikan_orangtua'] ?? null,
            'orangtua_kandung' => $validated['orangtua_kandung'] ?? null,

            // rumah
            'kepemilikan_rumah' => $validated['kepemilikan_rumah'] ?? null,
            'tahun_perolehan' => $validated['tahun_perolehan'] ?? null,
            'sumber_listrik' => $validated['sumber_listrik'] ?? null,
            'luas_tanah' => $validated['luas_tanah'] ?? null,
            'luas_bangunan' => $validated['luas_bangunan'] ?? null,
            'mandi_cuci_kakus' => $validated['mandi_cuci_kakus'] ?? null,
            'sumber_air' => $validated['sumber_air'] ?? null,
            'jarak_dari_kota' => $validated['jarak_pusat_kota'] ?? null,
            'jumlah_orang_tinggal' => $validated['jumlah_orang_tinggal'] ?? null,

            // ekonomi
            'penghasilan_ayah' => $validated['penghasilan_ayah'] ?? null,
            'penghasilan_ibu' => $validated['penghasilan_ibu'] ?? null,
            'hutang' => $validated['hutang'] ?? null,
            'cicilan_per_bulan' => $validated['cicilan_perbulan'] ?? null,
            'piutang' => $validated['piutang'] ?? null,
            'tabungan' => $validated['tabungan'] ?? null,

            // kekayaan
            'sepeda_motor' => $validated['motor'] ?? null,
            'mobil' => $validated['mobil'] ?? null,
            'kebun_hektar' => $validated['kebun'] ?? null,

            'status' => 'Terkirim',
            'catatan_admin' => null,
            'pesan' => null
        ];

        Pengajuan::create($data);

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
            'pesan' => 'nullable|string'
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        $pengajuan->status = $request->status;
        $pengajuan->pesan = $request->pesan;
        $pengajuan->save();

        return back()->with('success', 'Status pengajuan berhasil diperbarui beserta pesan admin.');
    }


}
