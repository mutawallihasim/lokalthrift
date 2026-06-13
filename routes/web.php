<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - LokalThrift Dinamis 2026
|--------------------------------------------------------------------------
*/

// Tampilan Halaman Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Tampilan Dashboard Utama (Website)
Route::get('/web-baru', function () {
    return view('dashboard'); 
});

// Tampilan Dashboard Versi Mobile
Route::get('/mobile-baru', function () {
    return view('dashboard_mobile');
});

// Talaman Halaman Keranjang Belanja
Route::get('/keranjang', function () {
    return view('keranjang'); 
});

// Tampilan Halaman Detail Produk
Route::get('/detail', function () {
    return view('detail'); 
});

// Tampilan Halaman Ringkasan Checkout
Route::get('/checkout', function () {
    return view('checkout'); 
});


/*
|--------------------------------------------------------------------------
| Logika Backend / Proses Session Data
|--------------------------------------------------------------------------
*/

// PROSES A: Memasukkan barang ke dalam Session Keranjang Belanja
Route::post('/add-to-cart', function (Request $request) {
    $cart = session()->get('cart', []);

    $id = $request->input('id');
    $nama = $request->input('nama');
    $harga = $request->input('harga');
    $gambar = $request->input('gambar');
    $ukuran = $request->input('ukuran');
    $kondisi = $request->input('kondisi');

    // Kunci unik gabungan id produk dan ukuran agar tidak tumpang tindih
    $cartKey = $id . '_' . $ukuran;
    
    if (isset($cart[$cartKey])) {
        $cart[$cartKey]['jumlah']++;
    } else {
        $cart[$cartKey] = [
            "id" => $id,
            "nama" => $nama,
            "harga" => $harga,
            "gambar" => $gambar,
            "ukuran" => $ukuran,
            "kondisi" => $kondisi,
            "jumlah" => 1
        ];
    }

    session()->put('cart', $cart);
    return response()->json(['status' => 'success', 'cart_count' => count($cart)]);
});

// PROSES B: Mengirim data barang terpilih ke Session Checkout (Versi Strip)
Route::post('/set-checkout', function (Request $request) {
    $items = $request->input('items');
    if ($items) {
        session(['checkout_items' => $items]);
        return response()->json(['status' => 'success']);
    }
    return response()->json(['status' => 'error'], 400);
});

// PROSES C: Mengirim data barang terpilih ke Session Checkout (Versi Underscore)
Route::post('/set_checkout', function (Request $request) {
    $items = $request->input('items');
    if ($items) {
        session(['checkout_items' => $items]);
        return response()->json(['status' => 'success']);
    }
    return response()->json(['status' => 'error'], 400);
});

// LOGIKA TAMBAHAN: Menghapus item dari session keranjang
Route::post('/remove-from-cart', function (Request $request) {
    $cart = session()->get('cart', []);
    $key = $request->input('key');

    if (isset($cart[$key])) {
        unset($cart[$key]);
        session()->put('cart', $cart);
        return response()->json(['status' => 'success']);
    }
    return response()->json(['status' => 'error'], 400);
});

// LOGIKA TAMBAHAN: Mengubah / mengedit jumlah (kuantitas) barang di keranjang
Route::post('/update-cart-quantity', function (Request $request) {
    $cart = session()->get('cart', []);
    $key = $request->input('key');
    $action = $request->input('action'); // 'increase' atau 'decrease'

    if (isset($cart[$key])) {
        if ($action == 'increase') {
            $cart[$key]['jumlah']++;
        } elseif ($action == 'decrease') {
            $cart[$key]['jumlah']--;
            // Jika jumlahnya di bawah 1, otomatis hapus dari keranjang
            if ($cart[$key]['jumlah'] < 1) {
                unset($cart[$key]);
                session()->put('cart', $cart);
                return response()->json(['status' => 'success', 'removed' => true]);
            }
        }
        session()->put('cart', $cart);
        return response()->json(['status' => 'success', 'jumlah' => $cart[$key]['jumlah']]);
    }
    return response()->json(['status' => 'error'], 400);
});

// Tampilan Dashboard Penjual (Toko)
Route::get('/dashboard-penjual', function () {
    return view('dashboard_penjual');
});

// Tampilan Halaman Riwayat Pesanan Saya
Route::get('/pesanan', function () {
    return view('pesanan'); // Memanggil file pesanan.blade.php
});

// Tampilan Halaman Rincian Detail Pesanan
Route::get('/detail-pesanan', function () {
    return view('detail_pesanan'); // Memanggil file detail_pesanan.blade.php
});

// Tampilan Halaman Favorit Saya
Route::get('/favorit', function () {
    return view('favorit');
});

// Logika Backend: Menambahkan atau Menghapus Produk dari Session Favorit (Toggle)
Route::post('/toggle-favorit', function (Illuminate\Http\Request $request) {
    $favorites = session()->get('favorites', []);
    $id = $request->input('id');
    $nama = $request->input('nama');
    $harga = $request->input('harga');
    $gambar = $request->input('gambar');

    if (isset($favorites[$id])) {
        // Jika sudah ada, berarti klik kedua kali untuk menghapus (unfavorite)
        unset($favorites[$id]);
        $status = 'removed';
    } else {
        // Jika belum ada, masukkan ke data favorit
        $favorites[$id] = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'gambar' => $gambar
        ];
        $status = 'added';
    }

    session()->put('favorites', $favorites);
    return response()->json(['status' => 'success', 'action' => $status, 'count' => count($favorites)]);
});

// LOGIKA TAMBAHAN: Memindahkan barang checkout ke dalam riwayat pesanan (Dinamis)
Route::post('/create-order', function (Request $request) {
    $checkoutItems = session()->get('checkout_items', []);
    
    if (empty($checkoutItems)) {
        return response()->json(['status' => 'error', 'message' => 'Tidak ada barang untuk dipesan'], 400);
    }

    // Ambil data pesanan yang sudah ada atau siapkan array kosong
    $orders = session()->get('orders_history', []);
    
    // Buat nomor invoice unik acak mirip format UI kamu
    $invoiceNumber = 'LT240S' . rand(100000, 999999);
    $totalHarga = 0;
    $images = [];

    foreach ($checkoutItems as $item) {
        $totalHarga += intval($item['harga']);
        $images[] = $item['gambar'];
    }

    // Masukkan data pesanan baru ke baris paling atas riwayat
    array_unshift($orders, [
        'invoice' => $invoiceNumber,
        'date' => date('d M Y • H:i'),
        'status' => 'diproses', // Otomatis berstatus diproses saat baru memesan
        'total' => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
        'jumlah_barang' => count($checkoutItems),
        'images' => $images,
        'products_detail' => $checkoutItems
    ]);

    // Simpan ke session riwayat pesanan
    session()->put('orders_history', $orders);
    
    // Bersihkan session checkout dan session keranjang karena barang sudah dibeli
    session()->forget('checkout_items');
    session()->forget('cart');

    return response()->json(['status' => 'success', 'invoice' => $invoiceNumber]);
});