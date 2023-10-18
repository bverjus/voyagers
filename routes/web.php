<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/itineraires', function(){
//     return view('itineraires');
// })->name('itineraires');

Route::get('/itineraires', [\App\Http\Controllers\ItinerairesController::class, 'index'])->name('itineraires.index');

Route::get('/itineraire/{id}', [\App\Http\Controllers\ItinerairesController::class, 'show'])->name('itineraire.show');

Route::post('/generation', [\App\Http\Controllers\GenerationController::class, 'generate'])->name('generation.generate');

Route::post('/sauvegarder-itineraire', [\App\Http\Controllers\ItinerairesController::class, 'sauvegarderItineraire'])->name('sauvegarder');

Route::delete('/itineraire/delete/{id}', [\App\Http\Controllers\ItinerairesController::class, 'destroy'])->name('itineraire.destroy');

Route::put('/itineraire/update/{id}', [\App\Http\Controllers\ItinerairesController::class, 'update'])->name('itineraire.update');

Route::get('/itineraire/{id}/pdf',  [\App\Http\Controllers\ItinerairesController::class, 'generatePDF'])->name('itineraire.pdf');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
