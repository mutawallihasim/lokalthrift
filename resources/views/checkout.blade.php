<?php
// AMBIL DATA DARI SESSION LARAVEL (Gaya Blade/Laravel)
$keranjang = session('checkout_items', [
    // Template fallback jika diakses langsung tanpa lewat keranjang/detail
    [
        "nama" => "Crewneck Michigan State Vintage",
        "varian" => "Warna Default, M",
        "harga" => 85000,
        "gambar" => "https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=200"
    ]
]);

$subtotal = 0;
foreach($keranjang as $item) {
    $subtotal += $item['harga'];
}

$ongkir = 15000; 
$total_pembayaran = $subtotal + $ongkir;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - LokalThrift</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-blue: #2a85ff;
      --primary-hover: #1b6fd1;
      --secondary-blue: #0d1c2e;
      --text-dark: #0f172a;
      --text-gray: #64748B;
      --bg-light: #f4f8fc;
      --bg-white: #FFFFFF;
      --border-color: #E2E8F0;
      --success-green: #10B981;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
    body { background: var(--bg-light); color: var(--text-dark); }

    .checkout-container { max-width: 1200px; margin: 0 auto; padding: 30px 20px; }

    /* Header */
    .header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 1px solid var(--border-color); }
    .header a { text-decoration: none; color: var(--text-dark); font-size: 20px; font-weight: bold; }
    .header h1 { font-size: 24px; color: var(--secondary-blue); }

    /* Layout Grid */
    .checkout-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; align-items: start; }

    /* Cards */
    .section-card { background: var(--bg-white); border-radius: 12px; padding: 25px; margin-bottom: 20px; border: 1px solid var(--border-color); box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
    .section-title { font-size: 18px; font-weight: 600; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
    .ubah-btn { font-size: 14px; color: var(--primary-blue); cursor: pointer; font-weight: 500; text-decoration: none; }

    /* Alamat */
    .address-box { border: 1px solid var(--primary-blue); background: #EFF6FF; padding: 15px; border-radius: 8px; position: relative; }
    .address-badge { background: var(--success-green); color: white; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; display: inline-block; margin-bottom: 8px; }
    .address-box h4 { font-size: 15px; margin-bottom: 5px; }
    .address-box p { font-size: 14px; color: var(--text-gray); line-height: 1.5; }

    /* Radio Options */
    .option-group { display: flex; flex-direction: column; gap: 12px; }
    .option-label { display: flex; justify-content: space-between; align-items: center; border: 1px solid var(--border-color); padding: 15px; border-radius: 8px; cursor: pointer; transition: 0.2s; }
    .option-label:hover { border-color: var(--primary-blue); background: #F8FAFC; }
    .option-label input[type="radio"] { margin-right: 12px; accent-color: var(--primary-blue); transform: scale(1.2); }
    .option-info { display: flex; align-items: center; font-size: 14px; font-weight: 500; }
    .option-price { font-weight: 600; color: var(--primary-blue); font-size: 14px; }
    
    /* Grid Pembayaran */
    .pay-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .pay-card { border: 1px solid var(--border-color); padding: 15px; border-radius: 8px; display: flex; align-items: center; gap: 10px; cursor: pointer; }
    .pay-card:hover { border-color: var(--primary-blue); }
    .pay-card input[type="radio"] { accent-color: var(--primary-blue); }
    .bank-logo { font-weight: 800; font-style: italic; font-size: 16px; }
    .text-bca { color: #0066AE; }
    .text-bri { color: #00529C; }
    .text-bni { color: #F15A23; }
    .text-mandiri { color: #003D79; }

    /* Ringkasan Pesanan (Kanan) */
    .item-list { display: flex; flex-direction: column; gap: 15px; margin-bottom: 25px; }
    .item { display: flex; gap: 15px; align-items: center; }
    .item img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color); }
    .item-details { flex: 1; }
    .item-name { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
    .item-var { font-size: 12px; color: var(--text-gray); }
    .item-price { font-size: 14px; font-weight: 700; }

    .summary-math { border-top: 1px dashed var(--border-color); padding-top: 15px; margin-bottom: 20px; }
    .math-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px; color: var(--text-gray); }
    .math-total { display: flex; justify-content: space-between; font-size: 18px; font-weight: 700; color: var(--text-dark); margin-top: 15px; border-top: 1px solid var(--border-color); padding-top: 15px; }

    .btn-bayar { width: 100%; padding: 15px; background: var(--primary-blue); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s; text-align: center; }
    .btn-bayar:hover { background: var(--primary-hover); transform: translateY(-2px); }

    @media (max-width: 900px) {
      .checkout-grid { grid-template-columns: 1fr; }
      .pay-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<div class="checkout-container">
  
  <div class="header">
    <a href="/keranjang">←</a>
    <h1>Checkout</h1>
  </div>

  <div class="checkout-grid">
    
    <div class="checkout-left">
      <div class="section-card">
        <div class="section-title">
          Alamat Pengiriman <span class="ubah-btn">Ubah</span>
        </div>
        <div class="address-box">
          <span class="address-badge">Utama</span>
          <h4>Rumah</h4>
          <p>Sabila Nur Sakila<br>
          Jl. Bau Massepe No. 12, Kec. Soreang<br>
          Kota Parepare, Sulawesi Selatan 91113</p>
        </div>
      </div>

      <div class="section-card">
        <div class="section-title">Metode Pengiriman</div>
        <div class="option-group">
          <label class="option-label">
            <div class="option-info">
              <input type="radio" name="pengiriman" value="jne_reg" checked onclick="updateOngkir(15000)"> JNE Reguler (2-3 hari)
            </div>
            <div class="option-price">Rp 15.000</div>
          </label>
          <label class="option-label">
            <div class="option-info">
              <input type="radio" name="pengiriman" value="sicepat" onclick="updateOngkir(13000)"> SiCepat Reguler (2-3 hari)
            </div>
            <div class="option-price">Rp 13.000</div>
          </label>
        </div>
      </div>

      <div class="section-card">
        <div class="section-title">Metode Pembayaran</div>
        <p style="font-size: 14px; font-weight: 600; margin-bottom: 10px;">Transfer Bank / Mobile Banking</p>
        <div class="pay-grid" style="margin-bottom: 20px;">
          <label class="pay-card">
            <input type="radio" name="pembayaran" value="bri" checked> 
            <span class="bank-logo text-bri">BRI</span> (BRImo)
          </label>
          <label class="pay-card">
            <input type="radio" name="pembayaran" value="bni"> 
            <span class="bank-logo text-bni">BNI</span> (wondr)
          </label>
        </div>

        <p style="font-size: 14px; font-weight: 600; margin-bottom: 10px;">E-Wallet</p>
        <div class="pay-grid">
          <label class="pay-card"><input type="radio" name="pembayaran" value="qris"> QRIS</label>
          <label class="pay-card"><input type="radio" name="pembayaran" value="dana"> DANA</label>
        </div>
      </div>
    </div>

    <div class="checkout-right">
      <div class="section-card" style="position: sticky; top: 20px;">
        <div class="section-title">Ringkasan Pesanan</div>
        
        <div class="item-list">
          <?php foreach($keranjang as $item): ?>
          <div class="item">
            <img src="<?= $item['gambar'] ?>" alt="Produk" onerror="this.src='https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=100'">
            <div class="item-details">
              <div class="item-name"><?= htmlspecialchars($item['nama']) ?></div>
              <div class="item-var"><?= htmlspecialchars($item['varian']) ?></div>
            </div>
            <div class="item-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="summary-math">
          <div class="math-row">
            <span>Subtotal (<?= count($keranjang) ?> barang)</span>
            <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
          </div>
          <div class="math-row">
            <span>Ongkos Kirim</span>
            <span id="ongkir-display">Rp <?= number_format($ongkir, 0, ',', '.') ?></span>
          </div>
          <div class="math-total">
            <span>Total Pembayaran</span>
            <span id="total-display">Rp <?= number_format($total_pembayaran, 0, ',', '.') ?></span>
          </div>
        </div>

        <button type="button" class="btn-bayar" onclick="prosesBayar()">Bayar Sekarang</button>
      </div>
    </div>

  </div>
</div>

<script>
  const subtotal = <?= $subtotal ?>;

  function updateOngkir(biaya) {
    document.getElementById('ongkir-display').innerText = "Rp " + biaya.toLocaleString('id-ID');
    const total = subtotal + biaya;
    document.getElementById('total-display').innerText = "Rp " + total.toLocaleString('id-ID');
  }

  function prosesBayar() {
    alert("Pembayaran Berhasil! Terhubung dengan mobile banking.");
  }
</script>

</body>
</html>