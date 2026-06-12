<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Belanja - LokalThrift</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body {
      background-color: #f4f8fc; /* Latar belakang pale/terang sesuai UI */
      color: #0d1c2e;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* TOP NAVBAR */
    .top-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 18px 5%;
      background-color: #ffffff;
      border-bottom: 1px solid #eef2f7;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: #0d1c2e;
      font-weight: 700;
      font-size: 20px;
    }

    .brand i {
      color: #2a85ff;
    }

    .search-container {
      position: relative;
      width: 40%;
    }

    .search-container input {
      width: 100%;
      padding: 10px 16px 10px 40px;
      border: 1px solid #ccd6e0;
      border-radius: 9999px;
      background-color: #f8fbfe;
      color: #0d1c2e;
      outline: none;
      font-size: 14px;
    }

    .search-container i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #7d8c9e;
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 24px;
    }

    .nav-actions a {
      color: #556980;
      text-decoration: none;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* MAIN CONTENT WRAPPER */
    .cart-wrapper {
      width: 90%;
      max-width: 1200px;
      margin: 40px auto;
      flex: 1;
    }

    /* STYLE BARU: TOMBOL KEMBALI MINIMALIS */
    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #556980;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 16px;
      transition: color 0.2s;
    }

    .btn-back:hover {
      color: #2a85ff;
    }

    .cart-title {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 24px;
      color: #0d1c2e;
    }

    .cart-container {
      display: flex;
      gap: 25px;
      align-items: flex-start;
    }

    /* LIST PRODUK (KARTU PUTIH BERSIH SESUAI UI) */
    .cart-items-list {
      flex: 2;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .cart-item {
      display: flex;
      align-items: center;
      background-color: #ffffff;
      border: 1px solid #eef2f7;
      border-radius: 16px;
      padding: 20px;
      position: relative;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    /* Checkbox & Image */
    .item-checkbox {
      width: 20px;
      height: 20px;
      accent-color: #2a85ff;
      cursor: pointer;
      margin-right: 20px;
    }

    .item-img-wrapper {
      width: 100px;
      height: 100px;
      border-radius: 12px;
      overflow: hidden;
      margin-right: 24px;
      background-color: #f8fbfe;
    }

    .item-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Detail Teks Informasi */
    .item-details {
      flex: 1;
    }

    .item-name {
      font-size: 18px;
      font-weight: 600;
      color: #0d1c2e;
      margin-bottom: 8px;
    }

    /* Fitur Warna, Ukuran, Kondisi */
    .item-specs {
      display: flex;
      flex-direction: column;
      gap: 4px;
      font-size: 13px;
    }

    .spec-row {
      display: flex;
      gap: 6px;
    }

    .spec-label {
      color: #7d8c9e;
      font-weight: 500;
    }

    .spec-value {
      color: #334155;
    }

    /* Kolom Kanan: Counter & Harga */
    .item-right-actions {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 16px;
      margin-right: 40px;
    }

    .item-price {
      font-size: 18px;
      font-weight: 700;
      color: #0d1c2e;
    }

    /* Fitur Jumlah Produk (Quantity Counter Biru Cerah) */
    .quantity-control {
      display: flex;
      align-items: center;
      background-color: #f8fbfe;
      border: 1px solid #ccd6e0;
      border-radius: 8px;
      overflow: hidden;
    }

    .qty-btn {
      width: 32px;
      height: 32px;
      border: none;
      background: transparent;
      color: #2a85ff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }

    .qty-btn:hover {
      background-color: #eef5fc;
    }

    .qty-input {
      width: 40px;
      height: 32px;
      border: none;
      border-left: 1px solid #ccd6e0;
      border-right: 1px solid #ccd6e0;
      background-color: #ffffff;
      color: #0d1c2e;
      text-align: center;
      font-size: 14px;
      font-weight: 600;
      outline: none;
    }

    /* Tombol Sampah Hapus */
    .btn-delete {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #7d8c9e;
      font-size: 18px;
      cursor: pointer;
      transition: color 0.2s;
    }

    .btn-delete:hover {
      color: #ef4444;
    }

    /* RINGKASAN BELANJA */
    .summary-card {
      flex: 1;
      max-width: 400px;
      background: #ffffff;
      border: 1px solid #eef2f7;
      border-radius: 16px;
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.01);
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .summary-title {
      font-size: 16px;
      font-weight: bold;
      color: #0d1c2e;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      color: #556980;
    }

    .summary-divider {
      height: 1px;
      background: #eef3f8;
      margin: 5px 0;
    }

    .total-title {
      font-size: 15px;
      font-weight: bold;
      color: #0d1c2e;
    }

    .total-price {
      font-size: 20px;
      font-weight: 800;
      color: #0d1c2e;
    }

    .btn-checkout {
      display: block;
      width: 100%;
      padding: 14px;
      background-color: #2a85ff;
      color: white;
      font-weight: bold;
      font-size: 14px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(42, 133, 255, 0.2);
      transition: opacity 0.2s;
    }

    .btn-checkout:hover {
      opacity: 0.9;
    }

    @media (max-width: 900px) {
      .cart-container {
        flex-direction: column;
      }
      .summary-card {
        max-width: 100%;
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="top-nav">
    <a href="/web-baru" class="brand">
      <i class="fa-solid fa-cloud-bolt"></i>
      <span>LokalThrift</span>
    </a>
    <div class="search-container">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" placeholder="Search products...">
    </div>
    <div class="nav-actions">
      <a href="/keranjang"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a>
      <a href="/akun"><i class="fa-regular fa-user"></i> Akun</a>
    </div>
  </div>

  <div class="cart-wrapper">
    
    <a href="/web-baru" class="btn-back">
      <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>

    <div class="cart-title">Keranjang Belanja</div>

    <div class="cart-container">
      <div class="cart-items-list">
        
        <div class="cart-item" data-price="85000">
          <input type="checkbox" class="item-checkbox" checked onclick="hitungTotal()">
          <div class="item-img-wrapper">
            <img src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=200" alt="Crewneck">
          </div>
          <div class="item-details">
            <div class="item-name">Crewneck Michigan State Vintage</div>
            <div class="item-specs">
              <div class="spec-row"><span class="spec-label">Warna:</span> <span class="spec-value">Green (M)</span></div>
              <div class="spec-row"><span class="spec-label">Ukuran:</span> <span class="spec-value">M</span></div>
              <div class="spec-row"><span class="spec-label">Kondisi:</span> <span class="spec-value">Very Good</span></div>
            </div>
          </div>
          <div class="item-right-actions">
            <div class="item-price">Rp 85.000</div>
            <div class="quantity-control">
              <button class="qty-btn" onclick="ubahJumlah(this, -1)">-</button>
              <input type="text" class="qty-input" value="1" readonly>
              <button class="qty-btn" onclick="ubahJumlah(this, 1)">+</button>
            </div>
          </div>
          <button class="btn-delete" onclick="hapusItem(this)"><i class="fa-regular fa-trash-can"></i></button>
        </div>

        <div class="cart-item" data-price="120000">
          <input type="checkbox" class="item-checkbox" checked onclick="hitungTotal()">
          <div class="item-img-wrapper">
            <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=200" alt="Jacket">
          </div>
          <div class="item-details">
            <div class="item-name">Denim Jacket Vintage Blue</div>
            <div class="item-specs">
              <div class="spec-row"><span class="spec-label">Warna:</span> <span class="spec-value">Light Blue</span></div>
              <div class="spec-row"><span class="spec-label">Ukuran:</span> <span class="spec-value">L</span></div>
              <div class="spec-row"><span class="spec-label">Kondisi:</span> <span class="spec-value">Like New</span></div>
            </div>
          </div>
          <div class="item-right-actions">
            <div class="item-price">Rp 120.000</div>
            <div class="quantity-control">
              <button class="qty-btn" onclick="ubahJumlah(this, -1)">-</button>
              <input type="text" class="qty-input" value="1" readonly>
              <button class="qty-btn" onclick="ubahJumlah(this, 1)">+</button>
            </div>
          </div>
          <button class="btn-delete" onclick="hapusItem(this)"><i class="fa-regular fa-trash-can"></i></button>
        </div>

      </div>

      <div class="summary-card">
        <div class="summary-title">Ringkasan Belanja</div>
        <div class="summary-row">
          <span>Subtotal</span>
          <span id="subtotal-display">Rp 205.000</span>
        </div>
        <div class="summary-row">
          <span>Pengiriman</span>
          <span style="color: #7d8c9e;">Gratis</span>
        </div>
        <div class="summary-divider"></div>
        <div class="summary-row" style="align-items: center;">
          <span class="total-title">Total Belanja</span>
          <span class="total-price" id="total-display">Rp 205.000</span>
        </div>
        <button class="btn-checkout" onclick="checkout()">Beli Sekarang</button>
      </div>
    </div>
  </div>

  <script>
    function ubahJumlah(btn, arah) {
      const input = btn.parentElement.querySelector('.qty-input');
      let currentVal = parseInt(input.value);
      currentVal += arah;
      
      if (currentVal < 1) currentVal = 1;
      input.value = currentVal;
      
      const itemRow = btn.closest('.cart-item');
      const basePrice = parseInt(itemRow.getAttribute('data-price'));
      const newPrice = basePrice * currentVal;
      itemRow.querySelector('.item-price').innerText = "Rp " + newPrice.toLocaleString('id-ID');
      
      hitungTotal();
    }

    function hapusItem(btn) {
      if (confirm("Hapus produk ini dari keranjang?")) {
        btn.closest('.cart-item').remove();
        hitungTotal();
      }
    }

    function hitungTotal() {
      let total = 0;
      const items = document.querySelectorAll('.cart-item');
      
      items.forEach(item => {
        const checkbox = item.querySelector('.item-checkbox');
        if (checkbox.checked) {
          const qty = parseInt(item.querySelector('.qty-input').value);
          const price = parseInt(item.getAttribute('data-price'));
          total += (price * qty);
        }
      });
      
      document.getElementById('subtotal-display').innerText = "Rp " + total.toLocaleString('id-ID');
      document.getElementById('total-display').innerText = "Rp " + total.toLocaleString('id-ID');
    }

    function checkout() {
    const itemsToCheckout = [];
    const checkedRows = document.querySelectorAll('.cart-item');

    checkedRows.forEach(row => {
        const checkbox = row.querySelector('.item-checkbox');
        if (checkbox.checked) {
            const nama = row.querySelector('.item-name').innerText;
            const harga = parseInt(row.getAttribute('data-price'));
            const gambar = row.querySelector('.item-img-wrapper img').src;
            
            // Ekstrak data teks varian warna/ukuran dari dalam dom
            const specText = row.querySelector('.item-specs').innerText.replace(/\n/g, ', ');

            itemsToCheckout.push({
                nama: nama,
                varian: specText,
                harga: harga,
                gambar: gambar
            });
        }
    });

    if (itemsToCheckout.length === 0) {
        alert("Pilih minimal satu produk yang ingin di-checkout!");
        return;
    }

    // Kirim array produk pilihan ke session
    fetch('/set_checkout.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: json.stringify({ items: itemsToCheckout })
    })
    .then(() => {
        window.location.href = "/checkout";
    });
}

    window.onload = function() {
      hitungTotal();
    };
  </script>
</body>
</html>