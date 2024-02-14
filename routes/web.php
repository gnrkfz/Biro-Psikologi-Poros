<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;
use App\Models\Klien;
use App\Models\User;
use App\Models\Test;

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

Route::get('/logout', [SessionController::class, 'logout']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin', [SessionController::class, 'loginadmin'])->name('admin.loginadmin');
Route::post('/admin/dashboard', [SessionController::class, 'loginadmin'])->name('admin.loginadmin');

Route::get('/klien', [KlienController::class, 'index'])->name('klien.index');
Route::get('/klien', [KlienController::class, 'klienlistday']);
Route::post('/klien/dashboard', [SessionController::class, 'loginklien'])->name('klien.loginklien');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('adminsettings', [AdminController::class, 'adminsettings'])->name('adminsettings');
    Route::put('updatepassword', [AdminController::class, 'updatepassword'])->name('updatepassword');
    Route::get('tambahadmin', [AdminController::class, 'tambahadmin'])->name('tambahadmin');
    Route::post('tambahadmin', [AdminController::class, 'createadmin'])->name('createadmin');
    Route::post('dashboard/tambahteskecerdasan', [AdminController::class, 'tambahteskecerdasan'])->name('tambahteskecerdasan');
    Route::post('dashboard/tambahteskecermatan', [AdminController::class, 'tambahteskecermatan'])->name('tambahteskecermatan');
    Route::get('test/{id}', function ($id) {
        $test = Test::find($id);
        if ($test->jenis === 'Tes Kecerdasan') {
            return redirect()->route('teskecerdasan', ['id' => $id]);
        } elseif ($test->jenis === 'Tes Kecermatan') {
            return redirect()->route('teskecermatan', ['id' => $id]);
        }
    })->name('test.detail');
    Route::delete('deletetest/{id}', [AdminController::class, 'deletetest'])->name('deletetest');
    Route::get('teskecerdasan/{id}', [AdminController::class, 'teskecerdasan'])->name('teskecerdasan');
    Route::post('teskecerdasan/{id}', [AdminController::class, 'tambahsoalteskecerdasan'])->name('tambahsoalteskecerdasan');
    Route::get('teskecerdasan/edit/{id}', [AdminController::class, 'detailsoalteskecerdasan'])->name('detailsoalteskecerdasan');
    Route::post('teskecerdasan/edit/{id}', [AdminController::class, 'editsoalteskecerdasan'])->name('editsoalteskecerdasan');
    Route::delete('teskecerdasan/delete/{id}', [AdminController::class, 'deletesoalkecerdasan'])->name('deletesoalkecerdasan');
    Route::get('teskecermatan/{id}', [AdminController::class, 'teskecermatan'])->name('teskecermatan');
    Route::post('teskecermatan/{id}', [AdminController::class, 'tambahsoalteskecermatan'])->name('tambahsoalteskecermatan');
    Route::delete('teskecermatan/delete/{id}', [AdminController::class, 'deletesoalkecermatan'])->name('deletesoalkecermatan');
    Route::get('daftarklien', [AdminController::class, 'daftarklien'])->name('admin.daftarklien');
    Route::post('daftarklien', [AdminController::class, 'tambahklien'])->name('tambahklien');
    Route::get('detailklien/{id}', [AdminController::class, 'detailklien'])->name('detailklien');
    Route::post('detailklien/edit', [AdminController::class, 'editklien'])->name('editklien');
    Route::get('detailklien/{id}/delete', [AdminController::class, 'deleteklien'])->name('deleteklien');
    Route::delete('detailklien/deleteformtes/{id}', [AdminController::class, 'deleteformtes'])->name('deleteformtes');
    Route::get('formtes/{id}', [AdminController::class, 'formtes'])->name('formtes');
    Route::post('formtes/', [AdminController::class, 'tambahformtes'])->name('tambahformtes');
    Route::get('detailriwayattes/{id}', [AdminController::class, 'detailriwayattes'])->name('detailriwayattes');
    Route::get('detailriwayattes/{id}/jawabanteskecerdasan', [AdminController::class, 'jawabanteskecerdasan'])->name('jawabanteskecerdasan');
    Route::get('detailriwayattes/{id}/cetaknilaiteskecerdasan', [AdminController::class, 'cetaknilaiteskecerdasan'])->name('cetaknilaiteskecerdasan');
    Route::get('detailriwayattes/{id}/cetaknilaiteskecermatan', [AdminController::class, 'cetaknilaiteskecermatan'])->name('cetaknilaiteskecermatan');
});

Route::group(['prefix' => 'klien', 'middleware' => ['auth']], function () {
    Route::get('dashboard', [KlienController::class, 'dashboard'])->name('klien.dashboard');
    Route::post('isidatadiri', [KlienController::class, 'isidatadiri'])->name('isidatadiri');
    Route::get('pengerjaanteskecerdasan/{id}', [KlienController::class, 'pengerjaanteskecerdasan'])->name('pengerjaanteskecerdasan');
    Route::post('pengerjaanteskecerdasan/submit', [KlienController::class, 'submitjawabanteskecerdasan'])->name('submitjawabanteskecerdasan');
    Route::get('pengerjaanteskecermatan/{id}/{sesi}', [KlienController::class, 'pengerjaanteskecermatan'])->name('pengerjaanteskecermatan');
    Route::post('pengerjaanteskecermatan/submit', [KlienController::class, 'submitjawabanteskecermatan'])->name('submitjawabanteskecermatan');
});