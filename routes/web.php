    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PredictController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\DashboardController;

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
        });

    require __DIR__ . '/auth.php';
