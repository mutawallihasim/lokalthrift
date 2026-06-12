<?php
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('login');
})->name('login');

// Jalur pintas untuk memaksa menampilkan versi website baru

Route::get('/web-baru', function () {
    return view('dashboard'); 
});

// Jalur pintas untuk memaksa menampilkan versi mobile di laptop
Route::get('/mobile-baru', function () {
    return view('dashboard_mobile');
});

Route::get('/keranjang', function () {
    return view('keranjang'); // Memanggil file keranjang.blade.php
});

Route::get('/detail', function () {
    return view('detail'); // Memanggil file detail.blade.php
});

Route::get('/checkout', function () {
    return view('checkout'); // Memanggil file checkout.blade.php
});

use Illuminate\Http\Request;

Route::post('/set-checkout', function (Request $request) {
    // Mengambil data items yang dikirim dari Javascript depan
    $items = $request->input('items');

    if ($items) {
        // Menyimpan data ke dalam Session bawaan Laravel
        session(['checkout_items' => $items]);
        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'error', 'message' => 'Data kosong'], 400);
});