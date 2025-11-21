<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PengajuanController;

use App\Http\Controllers\UserDashboardController;


Route::get('/', function () {
    return view('prediksi');
});

Route::get('/prediksi', [PredictController::class, 'index']);
Route::post('/prediksi', [PredictController::class, 'predict'])->name('predict');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/pengajuan/statistik', [DashboardController::class, 'charts'])
            ->name('admin.pengajuan.statistik');

        Route::get('/pengajuan/list', [DashboardController::class, 'list'])->name('admin.pengajuan.list');

        // RIWAYAT PENGAJUAN
        Route::get('/pengajuan/riwayat', [PengajuanController::class, 'riwayatAdmin'])
            ->name('admin.pengajuan.riwayat');

        

        Route::get('/pengajuan/{id}', [PengajuanController::class, 'showAdmin'])
            ->name('admin.pengajuan.show');

        Route::post('/pengajuan/{id}/status', [PengajuanController::class, 'updateStatus'])
            ->name('admin.pengajuan.updateStatus');
    });


Route::middleware(['auth'])->prefix('user')->group(function () {

    // Dashboard mahasiswa
    Route::get('/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    // Form buat pengajuan
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])
        ->name('pengajuan.create');

    // Proses simpan pengajuan
    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])
        ->name('pengajuan.store');

    Route::get('/pengajuan/success', function () {
        return view('pengajuan.success');
    })->name('pengajuan.success')->middleware('auth');

    // RIWAYAT PENGAJUAN
    Route::get('/pengajuan/riwayat', [PengajuanController::class, 'riwayat'])
        ->name('user.pengajuan.riwayat');

    // DETAIL PENGAJUAN 
    Route::get('/pengajuan/{id}/detail', [PengajuanController::class, 'detail'])
        ->name('user.pengajuan.detail');

});



Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();

    // jika ada role admin
    if ($user && $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // default: arahkan ke user dashboard (buat route user.dashboard seperti di bawah)
    return redirect()->route('user.dashboard');
})->name('dashboard');

require __DIR__ . '/auth.php';
