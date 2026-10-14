
    <?php

    use App\Http\Controllers\EtudiantController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', [EtudiantController::class, 'index'])->name('home');
    
    Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    });

    require __DIR__.'/settings.php';