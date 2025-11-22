<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanKeringanan;

class DashboardController extends Controller
{
    public function index()
    {
        // ===============================
        // CARD — TOTAL PENGAJUAN
        // ===============================
        $totalPengajuan = Pengajuan::count();

        $belumDilihat = Pengajuan::where('status', 'Terkirim')->count();

        // ===============================
        // PIE KECIL — Layak vs Tidak Layak
        // ===============================
        $layak = PengajuanKeringanan::where('hasil_prediksi', 'layak')->count();
        $tidakLayak = PengajuanKeringanan::where('hasil_prediksi', 'tidak layak')->count();

        // ===============================
        // LINE KECIL — Pengajuan per Bulan
        // ===============================
        $pengajuanBulanan = Pengajuan::select(
            DB::raw("MONTH(created_at) as bulan"),
            DB::raw("COUNT(*) as total")
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulan = $pengajuanBulanan->pluck('bulan')->map(function ($b) {
            return Carbon::create()->month($b)->translatedFormat('F');
        });

        $totalBulanan = $pengajuanBulanan->pluck('total');

        // KIRIM DATA MINIMAL KE DASHBOARD SAJA
        return view('dashboard.index', [
            'totalPengajuan' => $totalPengajuan,

            'layak' => $layak,
            'tidakLayak' => $tidakLayak,
            'belumDilihat' => $belumDilihat,


            'bulan' => $bulan,
            'totalBulanan' => $totalBulanan,
        ]);
    }

    public function charts()
    {
        // ===============================
        // 1. Pie Chart — Layak vs Tidak Layak
        // ===============================
        $layak = PengajuanKeringanan::where('hasil_prediksi', 'layak')->count();
        $tidakLayak = PengajuanKeringanan::where('hasil_prediksi', 'tidak layak')->count();


        // ===============================
        // 2. Line Chart — Pengajuan per Bulan
        // ===============================
        $pengajuanBulanan = PengajuanKeringanan::select(
            DB::raw("MONTH(created_at) as bulan"),
            DB::raw("COUNT(*) as total")
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulan = $pengajuanBulanan->pluck('bulan')->map(function ($b) {
            return Carbon::create()->month($b)->translatedFormat('F');
        });

        $totalBulanan = $pengajuanBulanan->pluck('total');


        // ===============================
        // 3. Bar Chart — Penghasilan Orang Tua (Kategori)
        // ===============================
        $kategoriPenghasilan = [
            '<1jt' => PengajuanKeringanan::where('penghasilan', '<', 1000000)->count(),
            '1-2jt' => PengajuanKeringanan::whereBetween('penghasilan', [1000000, 2000000])->count(),
            '2-3jt' => PengajuanKeringanan::whereBetween('penghasilan', [2000000, 3000000])->count(),
            '>3jt' => PengajuanKeringanan::where('penghasilan', '>', 3000000)->count(),
        ];


        // ===============================
        // 4. Horizontal Bar — Pekerjaan Orang Tua
        // ===============================
        $pekerjaanCount = PengajuanKeringanan::select('pekerjaan', DB::raw('COUNT(*) as total'))
            ->groupBy('pekerjaan')
            ->orderBy('total', 'DESC')
            ->get();

        $pekerjaanLabel = $pekerjaanCount->pluck('pekerjaan');
        $pekerjaanTotal = $pekerjaanCount->pluck('total');


        // ===============================
        // 5. Pie Chart — Kondisi Tempat Tinggal
        // ===============================
        $kondisiRumah = PengajuanKeringanan::select('tempat_tinggal', DB::raw('COUNT(*) as total'))
            ->groupBy('tempat_tinggal')
            ->pluck('total', 'tempat_tinggal');


        // ===============================
        // 6. Pie Chart — Status Anak
        // ===============================
        $statusAnak = PengajuanKeringanan::select('status_anak', DB::raw('COUNT(*) as total'))
            ->groupBy('status_anak')
            ->pluck('total', 'status_anak');


        // ===============================
        // 7. Bar Chart — Berdasarkan Prodi
        // ===============================
        $prodi = PengajuanKeringanan::select('prodi', DB::raw('COUNT(*) as total'))
            ->groupBy('prodi')
            ->orderBy('total', 'DESC')
            ->get();

        $prodiLabel = $prodi->pluck('prodi');
        $prodiTotal = $prodi->pluck('total');


        // ===============================
        // 8. Bar Chart — DTKS & SKTM
        // ===============================
        $dtks = PengajuanKeringanan::where('dtks', 1)->count();
        $non_dtks = PengajuanKeringanan::where('dtks', 0)->count();

        $sktm = PengajuanKeringanan::where('sktm', 1)->count();
        $non_sktm = PengajuanKeringanan::where('sktm', 0)->count();


        // ===============================
        // SEND TO VIEW
        // ===============================

        return view('pengajuan.statistik', [
            'layak' => $layak,
            'tidakLayak' => $tidakLayak,

            'bulan' => $bulan,
            'totalBulanan' => $totalBulanan,

            'kategoriPenghasilan' => $kategoriPenghasilan,

            'pekerjaanLabel' => $pekerjaanLabel,
            'pekerjaanTotal' => $pekerjaanTotal,

            'kondisiRumah' => $kondisiRumah,

            'statusAnak' => $statusAnak,

            'prodiLabel' => $prodiLabel,
            'prodiTotal' => $prodiTotal,

            'dtks' => $dtks,
            'non_dtks' => $non_dtks,
            'sktm' => $sktm,
            'non_sktm' => $non_sktm,
        ]);
    }


    public function list(Request $request)
    {
        $q = $request->query('q');

        $query = PengajuanKeringanan::query();

        if ($q) {
            $query->where(function ($qry) use ($q) {
                $qry->where('nama', 'like', "%{$q}%")
                    ->orWhere('nim', 'like', "%{$q}%")
                    ->orWhere('prodi', 'like', "%{$q}%");
            });
        }

        // ambil terbaru dulu, paginasi 15 per page
        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('pengajuan.list', compact('pengajuans'));
    }
}
