<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>Detail Produk - LokalThrift</title>
  
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
      background: #f4f8fc;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    /* KARTU UTAMA DETAIL PRODUK */
    .detail-container {
      width: 100%;
      max-width: 800px;
      background: white;
      border-radius: 24px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.03);
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    /* HEADER: BACK & WISHLIST */
    .detail-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn-back {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #556980;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
    }

    .btn-wishlist {
      width: 36px;
      height: 36px;
      background: #f8fbfe;
      border: 1px solid #e2edf7;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #2a85ff;
      cursor: pointer;
    }

    /* KONTEN UTAMA */
    .main-content {
      display: flex;
      gap: 30px;
    }

    /* GALERI GAMBAR */
    .image-gallery {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .main-img-wrapper {
      width: 100%;
      aspect-ratio: 1 / 1;
      background: #f8fbfe;
      border-radius: 20px;
      overflow: hidden;
    }

    .main-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: all 0.3s ease;
    }

    .thumb-list {
      display: flex;
      gap: 10px;
    }

    .thumb-item {
      width: 65px;
      height: 65px;
      background: #f8fbfe;
      border: 2px solid transparent;
      border-radius: 12px;
      overflow: hidden;
      cursor: pointer;
    }

    .thumb-item.active {
      border-color: #2a85ff;
    }

    .thumb-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* INFORMASI PRODUK */
    .info-section {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .product-title {
      font-size: 22px;
      font-weight: bold;
      color: #0d1c2e;
      line-height: 1.3;
    }

    .product-price {
      font-size: 20px;
      font-weight: 800;
      color: #2a85ff;
    }

    .stats-row {
      display: flex;
      gap: 20px;
      font-size: 13px;
      color: #7d8c9e;
      align-items: center;
    }

    .rating {
      color: #ffa800;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .size-section h4, .condition-section h4, .desc-section h4 {
      font-size: 13px;
      color: #7d8c9e;
      margin-bottom: 8px;
      text-transform: uppercase;
    }

    .size-options {
      display: flex;
      gap: 10px;
    }

    .size-btn {
      width: 45px;
      height: 38px;
      border: 1px solid #e2edf7;
      background: #f8fbfe;
      border-radius: 8px;
      font-size: 13px;
      font-weight: bold;
      color: #556980;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
    }

    .size-btn.active {
      border: 2px solid #2a85ff;
      background: #eef5fc;
      color: #2a85ff;
    }

    .badge-condition {
      display: inline-block;
      padding: 8px 16px;
      background: #eef5fc;
      color: #2a85ff;
      font-size: 13px;
      font-weight: 600;
      border-radius: 8px;
      border: 1px solid #d4e8ff;
    }

    .desc-text {
      font-size: 13px;
      color: #556980;
      line-height: 1.5;
      margin-bottom: 10px;
    }

    .bullet-points {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .bullet-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: #556980;
    }

    .bullet-item i {
      color: #7d8c9e;
      width: 15px;
    }

    /* BUTTONS TINDAKAN */
    .action-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 5px;
    }

    .btn-action {
      width: 100%;
      padding: 14px;
      font-size: 14px;
      font-weight: bold;
      border-radius: 12px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
    }

    .btn-primary {
      background: #2a85ff;
      color: white;
      border: none;
      box-shadow: 0 4px 12px rgba(42, 133, 255, 0.2);
    }

    .btn-secondary {
      background: white;
      color: #2a85ff;
      border: 1px solid #2a85ff;
    }

    @media (max-width: 600px) {
      .main-content {
        flex-direction: column;
      }
      .detail-container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<div class="detail-container">
  
  <div class="detail-header">
    <a href="/web-baru" class="btn-back">
      <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
    <button class="btn-wishlist" id="wishlist-toggle" onclick="toggleFav()">
      <i class="fa-regular fa-heart"></i>
    </button>
  </div>

  <div class="main-content">
    
    <div class="image-gallery">
      <div class="main-img-wrapper">
        <img id="main-product-image" src="" alt="Gambar Produk">
      </div>
      
      <div class="thumb-list" id="thumbnail-container">
        </div>
    </div>

    <div class="info-section">
      <div>
        <h1 class="product-title" id="product-title">Nama Produk</h1>
        <div class="product-price" id="product-price" style="margin-top: 5px;">Rp 0</div>
      </div>

      <div class="stats-row">
        <div class="rating">
          <i class="fa-solid fa-star"></i> <span>4.8 (100)</span>
        </div>
        <div>•</div>
        <div>Terjual 320</div>
      </div>

      <div class="size-section">
        <h4>Pilih Ukuran</h4>
        <div class="size-options">
          <button class="size-btn" onclick="pilihUkuran(this)">S</button>
          <button class="size-btn active" onclick="pilihUkuran(this)">M</button>
          <button class="size-btn" onclick="pilihUkuran(this)">L</button>
          <button class="size-btn" onclick="pilihUkuran(this)">XL</button>
        </div>
      </div>

      <div class="condition-section">
        <h4>Kondisi</h4>
        <div class="badge-condition" id="product-condition">Very Good</div>
      </div>

      <div class="desc-section">
        <h4>Deskripsi</h4>
        <p class="desc-text" id="product-desc">
          Deskripsi produk.
        </p>
        
        <div class="bullet-points">
          <div class="bullet-item"><i class="fa-regular fa-circle-check"></i> 100% Original</div>
          <div class="bullet-item"><i class="fa-regular fa-circle-check"></i> Dicuci & Steril</div>
          <div class="bullet-item"><i class="fa-regular fa-circle-check"></i> Packing Aman</div>
        </div>
      </div>

    </div>

  </div>

  <div class="action-buttons">
    <button class="btn-action btn-primary" onclick="aksiKeranjang()">+ Tambah ke Keranjang</button>
    <button class="btn-action btn-secondary" onclick="aksiBeli()">Beli Sekarang</button>
  </div>

</div>

<script>
  // DATA MOCK KATALOG (SINKRON DENGAN ID DASHBOARD)
  const dataKatalog = {
    "1": {
      title: "Vintage Denim Jacket",
      price: "Rp 125.000",
      condition: "Excellent Condition",
      desc: "Jaket denim vintage original tebal dengan warna yang masih pekat. Jahitan kuat dan rapi, sangat cocok untuk style casual formal sehari-hari.",
      images: [
        "https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=500",
        "https://images.unsplash.com/photo-1516257984-b1b4d707412e?w=500"
      ]
    },
    "2": {
      title: "Crewneck Michigan State Vintage",
      price: "Rp 85.000",
      condition: "Very Good",
      desc: "Crewneck vintage warna hijau tua dengan sablon dada Michigan State original. Karet lengan dan pinggang masih kencang tanpa minus robek.",
      images: [
        "https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=500",
        "https://images.unsplash.com/photo-1618354691373-d851c5c3a990?w=500"
      ]
    },
    "3": {
      title: "Kemeja Flanel Casual",
      price: "Rp 75.000",
      condition: "Like New",
      desc: "Kemeja flanel bermotif kotak dengan bahan katun yang halus, adem, dan tidak bikin gerah. Kondisi 9.5/10 seperti baru beli dari toko.",
      images: [
        "https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=500",
        "https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=500"
      ]
    }
  };

  // AMBIL DATA BERDASARKAN ID DI URL
  window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id') || "1";
    const produk = dataKatalog[productId];

    if (produk) {
      document.getElementById('product-title').innerText = produk.title;
      document.getElementById('product-price').innerText = produk.price;
      document.getElementById('product-condition').innerText = produk.condition;
      document.getElementById('product-desc').innerText = produk.desc;
      document.getElementById('main-product-image').src = produk.images[0];

      const thumbContainer = document.getElementById('thumbnail-container');
      thumbContainer.innerHTML = "";
      produk.images.forEach((imgUrl, index) => {
        const activeClass = index === 0 ? "active" : "";
        thumbContainer.innerHTML += `
          <div class="thumb-item ${activeClass}" onclick="gantiFoto(this, '${imgUrl}')">
            <img src="${imgUrl}" alt="View ${index + 1}">
          </div>
        `;
      });
    }
  };

  function gantiFoto(element, urlGambar) {
    document.getElementById('main-product-image').src = urlGambar;
    document.querySelectorAll('.thumb-item').forEach(item => item.classList.remove('active'));
    element.classList.add('active');
  }

  function pilihUkuran(element) {
    document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('active'));
    element.classList.add('active');
  }

  let favorit = false;
  function toggleFav() {
    const icon = document.getElementById('wishlist-toggle').querySelector('i');
    favorit = !favorit;
    icon.className = favorit ? "fa-solid fa-heart" : "fa-regular fa-heart";
    icon.style.color = favorit ? "#ff4b4b" : "#2a85ff";
  }

  function aksiKeranjang() {
    alert("Produk berhasil ditambahkan ke keranjang belanja kamu!");
  }

  // DIUBAH MENJADI /set_checkout SESUAI DENGAN FILE WEB.PHP KAMU
  function aksiBeli() {
    const namaProduk = document.getElementById('product-title').innerText;
    const hargaProdukStr = document.getElementById('product-price').innerText;
    const hargaProduk = parseInt(hargaProdukStr.replace(/[^0-9]/g, ''));
    const gambarProduk = document.getElementById('main-product-image').src;
    const ukuranAktif = document.querySelector('.size-btn.active').innerText;

    const produkCheckout = [{
        nama: namaProduk,
        varian: "Original, Size " + ukuranAktif,
        harga: hargaProduk,
        gambar: gambarProduk
    }];

    // Tangkap CSRF token dari elemen meta head
    const tokenElement = document.querySelector('meta[name="csrf-token"]');
    const token = tokenElement ? tokenElement.getAttribute('content') : '';

    // URL menggunakan underscore /set_checkout agar sinkron dengan web.php
    fetch('/set_checkout', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ items: produkCheckout })
    })
    .then(response => {
        if (response.ok) {
            window.location.href = "/checkout";
        } else {
            alert("Gagal memproses pengiriman data checkout. Coba lagi.");
        }
    })
    .catch(error => {
      console.error("Error:", error);
      alert("Terjadi kendala jaringan.");
    });
}
</script>

</body>
</html>