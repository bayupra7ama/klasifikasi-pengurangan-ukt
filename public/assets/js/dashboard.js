document.addEventListener("DOMContentLoaded", function () {
    // =====================================================
    // BASE STYLE CONFIG — BIAR SEMUA CHART SAMA KAYAK TEMPLATE
    // =====================================================
    function baseChartConfig(type = "bar", height = 320) {
        return {
            chart: {
                type: type,
                height: height,
                toolbar: { show: false },
                foreColor: "#adb0bb",
                fontFamily: "inherit",
            },
            colors: ["#5D87FF", "#49BEFF", "#ecf2ff", "#F9F9FD"],
            dataLabels: { enabled: false },
            stroke: {
                show: true,
                width: 3,
                curve: "smooth",
                colors: ["transparent"],
            },
            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
            },
            legend: { show: false },
            tooltip: { theme: "light" },
            responsive: [
                {
                    breakpoint: 600,
                    options: {
                        plotOptions: {
                            bar: { borderRadius: 3 },
                        },
                    },
                },
            ],
        };
    }

    /* =====================================================
       1. Pie Chart — LAYAK vs TIDAK LAYAK
    ===================================================== */
    let chartLayak = baseChartConfig("donut", 300);
    chartLayak.series = [dataLayak, dataTidakLayak];
    chartLayak.labels = ["Layak", "Tidak Layak"];
    chartLayak.stroke = { show: false };

    new ApexCharts(document.querySelector("#chart_layak"), chartLayak).render();

    /* =====================================================
       2. Line Chart — PENGAJUAN BULANAN
    ===================================================== */
    let chartBulanan = baseChartConfig("line", 320);
    chartBulanan.series = [
        {
            name: "Pengajuan",
            data: totalBulanan,
        },
    ];
    chartBulanan.xaxis = { categories: bulan };
    chartBulanan.stroke = { curve: "smooth", width: 3 };

    new ApexCharts(
        document.querySelector("#chart_bulanan"),
        chartBulanan
    ).render();

    /* =====================================================
       3. Bar Chart — KATEGORI PENGHASILAN
    ===================================================== */
    let chartPenghasilan = baseChartConfig("bar", 320);
    chartPenghasilan.series = [
        {
            name: "Jumlah",
            data: Object.values(penghasilanKategori),
        },
    ];
    chartPenghasilan.xaxis = {
        categories: Object.keys(penghasilanKategori),
        labels: {
            style: { cssClass: "grey--text lighten-2--text fill-color" },
        },
    };
    chartPenghasilan.plotOptions = {
        bar: {
            columnWidth: "35%",
            borderRadius: 6,
            borderRadiusApplication: "end",
        },
    };

    new ApexCharts(
        document.querySelector("#chart_penghasilan"),
        chartPenghasilan
    ).render();

    /* =====================================================
       4. Horizontal Bar Chart — PEKERJAAN
    ===================================================== */
    let chartPekerjaan = baseChartConfig("bar", 350);
    chartPekerjaan.series = [
        {
            name: "Jumlah",
            data: pekerjaanTotal,
        },
    ];
    chartPekerjaan.xaxis = { categories: pekerjaanLabel };
    chartPekerjaan.plotOptions = { bar: { horizontal: true, borderRadius: 6 } };

    new ApexCharts(
        document.querySelector("#chart_pekerjaan"),
        chartPekerjaan
    ).render();

    /* =====================================================
       5. Pie Chart — KONDISI TEMPAT TINGGAL
    ===================================================== */
    let chartRumah = baseChartConfig("donut", 300);
    chartRumah.series = Object.values(kondisiRumah);
    chartRumah.labels = Object.keys(kondisiRumah);
    chartRumah.stroke = { show: false };

    new ApexCharts(document.querySelector("#chart_rumah"), chartRumah).render();

    /* =====================================================
       6. Pie Chart — STATUS ANAK
    ===================================================== */
    let chartAnak = baseChartConfig("donut", 300);
    chartAnak.series = Object.values(statusAnak);
    chartAnak.labels = Object.keys(statusAnak);
    chartAnak.stroke = { show: false };

    new ApexCharts(document.querySelector("#chart_anak"), chartAnak).render();

    /* =====================================================
       7. Bar Chart — PRODI
    ===================================================== */
    let chartProdi = baseChartConfig("bar", 330);
    chartProdi.series = [
        {
            name: "Jumlah",
            data: prodiTotal,
        },
    ];
    chartProdi.xaxis = { categories: prodiLabel };
    chartProdi.plotOptions = {
        bar: {
            columnWidth: "35%",
            borderRadius: 6,
            borderRadiusApplication: "end",
        },
    };

    new ApexCharts(document.querySelector("#chart_prodi"), chartProdi).render();

    /* =====================================================
       8. Bar Chart — DTKS / SKTM
    ===================================================== */
    let chartDtksSktm = baseChartConfig("bar", 330);
    chartDtksSktm.series = [
        { name: "DTKS", data: [dtks, non_dtks] },
        { name: "SKTM", data: [sktm, non_sktm] },
    ];
    chartDtksSktm.xaxis = { categories: ["Punya", "Tidak Punya"] };
    chartDtksSktm.plotOptions = {
        bar: {
            columnWidth: "35%",
            borderRadius: 6,
            borderRadiusApplication: "end",
        },
    };

    new ApexCharts(
        document.querySelector("#chart_dtks_sktm"),
        chartDtksSktm
    ).render();
});

async function logoutFetch() {
    const token = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    try {
        const res = await fetch("{{ url('/logout') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            credentials: "same-origin",
        });

        if (res.ok) {
            // redirect after logout
            window.location.href = "{{ url('/') }}";
        } else {
            console.error("Logout failed", res.status);
            alert("Logout gagal");
        }
    } catch (e) {
        console.error(e);
        alert("Terjadi kesalahan saat logout");
    }
}
const prodiData = {
    "Teknik Perkapalan": [
        "D3 - Teknik Perkapalan",
        "D4 - Teknologi Rekayasa Aristektur Perkapalan",
    ],
    "Teknik Mesin": [
        "D3 - Teknik Mesin",
        "D4 - Teknik Mesin Produksi dan Perawatan",
    ],
    "Teknik Elektro": ["D3 - Teknik Elektronika", "D4 - Teknik Listrik"],
    "Teknik Sipil": [
        "D3 - Teknik Sipil",
        "D4 - Teknik Perancangan Jalan Dan Jembatan",
    ],
    "Administrasi Niaga": [
        "D4 - Bisnis Digital",
        "D4 - Administrasi Bisnis Internasional",
        "D4 - Akuntansi Keuangan Publik",
    ],
    "Teknik Informatika": [
        "D3 - Teknik Informatika",
        "D4 - Rekayasa Perangkat Lunak",
        "D4 - Keamanan Sistem Informasi",
    ],
    Bahasa: [
        "D3 - Bahasa Inggris",
        "D4 - Bahasa Inggris Untuk Komunikasi Bisnis Dan Profesional",
    ],
    Kemaritiman: ["D3 - Nautika", "D3 - Ketatalaksanaan Pelayaran Niaga"],
};

document.getElementById("jurusan").addEventListener("change", function () {
    let jurusan = this.value;
    let prodi = document.getElementById("prodi");
    prodi.innerHTML = '<option value="">Pilih Prodi</option>';

    if (prodiData[jurusan]) {
        prodiData[jurusan].forEach((p) => {
            prodi.innerHTML += `<option value="${p}">${p}</option>`;
        });
    }
});

// Format Rupiah Input
document.getElementById("penghasilan").addEventListener("input", function () {
    let val = this.value.replace(/\D/g, "");
    this.value = new Intl.NumberFormat("id-ID").format(val);
});


