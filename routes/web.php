<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestEditController;
use App\Models\Kelas;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Routes untuk Kaprodi (Peran Kaprodi)
Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    // CRUD Dosen
    Route::resource('dosen', DosenController::class);

    // CRUD Kelas
    Route::resource('kelas', KelasController::class)
    ->parameters([
        'kelas' => 'kelas' // Ganti 'kelas' dengan nama parameter yang diinginkan
    ]);
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // Tambahkan route lainnya sesuai kebutuhan Kaprodi
});
// Routes for Dosen (Peran Dosen)
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    // Routes for Edit Requests Management by Dosen
    Route::get('mahasiswa/edit-requests', [RequestEditController::class, 'index'])->name('mahasiswa.edit-requests');
    Route::post('mahasiswa/edit-requests/{editRequest}/approve', [RequestEditController::class, 'approve'])->name('mahasiswa.edit-requests.approve');
    Route::post('mahasiswa/edit-requests/{editRequest}/reject', [RequestEditController::class, 'reject'])->name('mahasiswa.edit-requests.reject');
});



// Routes for Mahasiswa (Profile)
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/request-edit', [ProfileController::class, 'requestEdit'])->name('profile.request-edit');
    Route::post('/profile/request-edit', [ProfileController::class, 'storeRequestEdit'])->name('profile.store-request-edit');


});


// Route untuk halaman dashboard (Hanya bisa diakses setelah login)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/dashboard/detail-profile', [DashboardController::class, 'detailProfile'])->name('dashboard.detail-profile');
Route::put('/dashboard/update-profile', [DashboardController::class, 'updateProfile'])->name('dashboard.update-profile');

Route::get('/dashboard/detail-dosen', [DashboardController::class, 'detailDosen'])->name('dashboard.detail-dosen');
Route::get('/dashboard/detail-mahasiswa', [DashboardController::class, 'detailMahasiswa'])->name('dashboard.detail-mahasiswa');
Route::get('/dashboard/detail-kelas', [DashboardController::class, 'detailKelas'])->name('dashboard.detail-kelas');
Route::post('/notifications/read', [DashboardController::class, 'markNotificationsAsRead'])->name('notifications.read');
Route::post('/notifications/markAllAsRead', [DashboardController::class, 'markAllNotificationsAsRead'])->name('notifications.markAllAsRead');
Route::post('/notifications/deleteAll', [DashboardController::class, 'deleteAllNotifications'])->name('notifications.deleteAll');
Route::post('/notifications/readOne', [DashboardController::class, 'markNotificationAsRead'])->name('notifications.readOne');

// Routes untuk otentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
