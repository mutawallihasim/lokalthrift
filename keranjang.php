<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Belanja - LokalThrift</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Helvetica Neue', Arial, sans-serif;
    }

    body {
      background: #eef5fc; /* Background luar soft blue */
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    /* CONTAINER UTAMA FULL SCREEN LAPTOP */
    .cart-container {
      width: 100%;
      max-width: 1200px;
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.05);
    }

    /* BRAND LOGO */
    .brand-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 25px;
    }

    .brand-header .logo {
      font-size: 28px;
      color: #2a85ff;
    }

    .brand-header .brand-name {
      font-size: 22px;
      font-weight: 800;
      color: #2a85ff;
    }

    /* KOTAK BIRU FASILITAS KERANJANG (Sesuai Mockup Figma) */
    .cart-box {
      background: #bce3ff;
      border-radius: 20px;
      padding: 30px;
    }

    .cart-box h2 {
      font-size: 22px;
      color: #000;
      margin-bottom: 20px;
    }

    /* DAFTAR ITEM BARANG */
    .items-list-container {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 25px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .cart-item {
      display: flex;
      align-items: center;
      padding: 20px;
      border-bottom: 1px solid #eef5fc;
      gap: 20px;
    }

    .cart-item:last-child {
      border-bottom: none;
    }

    /* CHECKBOX KUSTOM */
    .custom-checkbox {
      width: 22px;
      height: 22px;
      cursor: pointer;
      accent-color: #2a85ff;
    }

    /* GAMBAR PRODUK */
    .item-img-wrapper {
      width: 100px;
      height: 100px;
      background: #dbdbdb;
      border-radius: 12px;
      overflow: hidden;
    }

    .item-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* INFO DETAIL BARANG */
    .item-details {
      flex: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .item-title {
      font-size: 20px;
      font-weight: 500;
      color: #000;
    }

    .item-right-section {
      display: flex;
      align-items: center;
      gap: 40px;
    }

    .item-price {
      font-size: 18px;
      color: #333;
    }

    /* TOMBOL HAPUS (TONG SAMPAH) */
    .delete-btn {
      background: none;
      border: none;
      font-size: 20px;
      color: #000;
      cursor: pointer;
      transition: color 0.2s, transform 0.2s;
    }

    .delete-btn:hover {
      color: #ff3333;
      transform: scale(1.1);
    }

    /* BAGIAN BAWAH (FOOTER CHECKOUT) */
    .cart-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 10px;
    }

    .select-all-label {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 18px;
      font-weight: 500;
      color: #000;
      cursor: pointer;
    }

    .summary-section {
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .total-info {
      text-align: right;
      font-size: 16px;
      color: #000;
    }

    .total-info .total-price {
      font-size: 20px;
      font-weight: bold;
    }

    .checkout-btn {
      background: #4da6ff;
      color: white;
      border: none;
      padding: 14px 45px;
      font-size: 18px;
      font-weight: bold;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(77, 166, 255, 0.3);
      transition: background 0.2s;
    }

    .checkout-btn:hover {
      background: #2b8ff5;
    }

    /* NOTIFIKASI KOSONG */
    .empty-cart-message {
      text-align: center;
      padding: 40px 20px;
      font-size: 18px;
      color: #555;
    }

    .empty-cart-message a {
      color: #2a85ff;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="cart-container">

  <div class="brand-header">
    <div class="logo"><i class="fa-solid fa-cloud-bolt"></i></div>
    <div class="brand-name">LokalThrift</div>
  </div>

  <div class="cart-box">
    <h2>Keranjang Belanja</h2>

    <div class="items-list-container" id="items-list">
      </div>

    <div class="cart-footer">
      <label class="select-all-label">
        <input type="checkbox" class="custom-checkbox" id="select-all" checked onchange="togglePilihSemua(this)">
        Pilih Semua
      </label>

      <div class="summary-section">
        <div class="total-info">
          <div id="total-items">Total (0 barang)</div>
          <div class="total-price" id="total-price-display">Rp 0</div>
        </div>
        <button class="checkout-btn" onclick="prosesCheckout()">CheckOut</button>
      </div>
    </div>

  </div>

</div>

<script>
  // Fungsi utama untuk me-load dan menampilkan barang dari localStorage
  function renderKeranjang() {
    const container = document.getElementById('items-list');
    // Ambil data array dari memori browser
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

    // Jika keranjang kosong
    if (keranjang.length === 0) {
      container.innerHTML = `
        <div class="empty-cart-message">
          Keranjang belanja Anda masih kosong. <br>
          <a href="dashboard.php"><i class="fa-solid fa-store"></i> Mulai Belanja Sekarang</a>
        </div>
      `;
      updateTotal();
      return;
    }

    // Bangun HTML list barang secara dinamis
    let htmlContent = '';
    keranjang.forEach((produk, index) => {
      htmlContent += `
        <div class="cart-item">
          <input type="checkbox" class="custom-checkbox item-checkbox" checked data-index="${index}" onchange="updateTotal()">
          <div class="item-img-wrapper">
            <img src="${produk.gambar}" alt="${produk.nama}">
          </div>
          <div class="item-details">
            <div class="item-title">${produk.nama}</div>
            <div class="item-right-section">
              <div class="item-price">${produk.harga}</div>
              <button class="delete-btn" onclick="hapusItem(${index})">
                <i class="fa-regular fa-trash-can"></i>
              </button>
            </div>
          </div>
        </div>
      `;
    });

    container.innerHTML = htmlContent;
    updateTotal();
  }

  // Fungsi kalkulasi kalkulator harga otomatis saat dicentang/pilih semua
  function updateTotal() {
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const selectAllCheckbox = document.getElementById('select-all');
    
    let totalHarga = 0;
    let jumlahDicentang = 0;

    checkboxes.forEach((cb) => {
      if (cb.checked) {
        let index = cb.getAttribute('data-index');
        totalHarga += keranjang[index].harga_angka;
        jumlahDicentang++;
      }
    });

    // Sesuaikan status tombol 'Pilih Semua'
    if (checkboxes.length > 0 && jumlahDicentang === checkboxes.length) {
      selectAllCheckbox.checked = true;
    } else {
      selectAllCheckbox.checked = false;
    }

    // Update teks jumlah barang dan harga di layar
    document.getElementById('total-items').innerText = `Total (${jumlahDicentang} barang)`;
    document.getElementById('total-price-display').innerText = `Rp ${totalHarga.toLocaleString('id-ID')}`;
  }

  // Fungsi fitur checkbox 'Pilih Semua'
  function togglePilihSemua(source) {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    checkboxes.forEach((cb) => {
      cb.checked = source.checked;
    });
    updateTotal();
  }

  // Fungsi fitur hapus barang (Ikon Tong Sampah)
  function hapusItem(index) {
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
    
    // Konfirmasi hapus demi user experience
    if (confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
      keranjang.splice(index, 1); // Potong isi array berdasarkan index item
      localStorage.setItem('keranjang', JSON.stringify(keranjang)); // Simpan data terbaru
      renderKeranjang(); // Render ulang tampilan layar
    }
  }

  // Fungsi tombol CheckOut
  function prosesCheckout() {
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
    const checkboxes = document.querySelectorAll('.item-checkbox');
    
    let adaYangDipilih = false;
    checkboxes.forEach((cb) => {
      if (cb.checked) adaYangDipilih = true;
    });

    if (keranjang.length === 0) {
      alert('Keranjang belanja masih kosong, silakan pilih produk dulu!');
    } else if (!adaYangDipilih) {
      alert('Silakan centang minimal satu barang untuk di-checkout!');
    } else {
      alert('Pesanan Anda berhasil dikonfirmasi! Melanjutkan ke sistem pembayaran.');
      // Opsi tambahan: mengosongkan barang yang dicentang setelah checkout sukses
      // localStorage.removeItem('keranjang');
      // window.location.href = 'order.php';
    }
  }

  // Jalankan render fungsi pertama kali ketika halaman dimuat oleh browser
  window.onload = renderKeranjang;
</script>

</body>
</html>