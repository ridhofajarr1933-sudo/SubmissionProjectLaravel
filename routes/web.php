
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

// Route utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/halo', function () {
    return 'Halo, selamat datang di Laravel 13!';
});

Route::get('/waktu', fn () => now()->format('d-m-Y H:i:s'));

// Parameter wajib
Route::get('/profil/{nama}', function (string $nama) {
    return "Halo, {$nama}!";
});

// Parameter opsional
Route::get('/kategori/{nama?}', function (string $nama = 'semua') {
    return "Menampilkan kategori: {$nama}";
});

// Lebih dari satu parameter
Route::get('/kelas/{kode}/mahasiswa/{nim}', function (string $kode, string $nim) {
    return "Kelas {$kode}, NIM {$nim}";
});

// Pembatasan parameter
Route::get('/artikel/{id}', function (int $id) {
    return "Artikel nomor {$id}";
})->whereNumber('id');

Route::get('/pengguna/{username}', function (string $username) {
    return "Pengguna: {$username}";
})->whereAlpha('username');

Route::get('/kode/{kode}', function (string $kode) {
    return "Kode: {$kode}";
})->where('kode', '[A-Z]{3}[0-9]{2}');

// Route langsung ke View dan Named Route
Route::view('/tentang', 'tentang')->name('tentang');

Route::get('/kontak', function () {
    return view('kontak', ['email' => 'info@kampus.ac.id']);
})->name('kontak');

// Route Group dan Prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => 'Dashboard Admin')
        ->name('dashboard');

    Route::get('/pengaturan', fn () => 'Pengaturan Admin')
        ->name('pengaturan');
});

// Redirect
Route::redirect('/beranda', '/');

// =====================================
// LATIHAN MAHASISWA A, B, DAN C
// =====================================

// A. Profil mahasiswa
Route::get('/profil-mahasiswa', [
    MahasiswaController::class,
    'profil'
])->name('mahasiswa.profil');

// B. Daftar mahasiswa
Route::get('/mahasiswa', [
    MahasiswaController::class,
    'daftar'
])->name('mahasiswa.daftar');

// C. Detail mahasiswa berdasarkan NIM
Route::get('/mahasiswa/{nim}', [
    MahasiswaController::class,
    'detail'
])->name('mahasiswa.detail');

// Fallback harus berada paling bawah
Route::fallback(function () {
    return response('Halaman tidak ditemukan (kustom).', 404);
});
