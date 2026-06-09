<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk - LokalThrift</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Helvetica Neue', Arial, sans-serif;
    }

    body {
      background: #eef5fc; /* Warna background soft blue sesuai figma */
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    /* CONTAINER UTAMA FULL LAYAR LAPTOP */
    .detail-container {
      width: 100%;
      max-width: 1200px;
      background: #bce3ff; /* Warna background kontainer sesuai gambar */
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.05);
      position: relative;
    }

    /* TOMBOL KEMBALI */
    .back-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #000;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 30px;
      cursor: pointer;
      transition: transform 0.2s;
    }

    .back-btn:hover {
      transform: translateX(-5px);
    }

    /* LAYOUT KONTEN (KIRI: GAMBAR, KANAN: TEKS) */
    .main-content {
      display: flex;
      gap: 50px;
      margin-bottom: 40px;
    }

    /* BAGIAN KIRI - GAMBAR */
    .gallery-section {
      flex: 1;
      max-width: 450px;
    }

    .main-img-wrapper {
      width: 100%;
      aspect-ratio: 1 / 1;
      background: #dbdbdb; /* Warna abu-abu mockup figma */
      border-radius: 20px;
      overflow: hidden;
      margin-bottom: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .main-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* THUMBNAIL MINI DI BAWAH GAMBAR UTAMA */
    .thumbnail-list {
      display: flex;
      gap: 15px;
    }

    .thumb-item {
      width: 80px;
      height: 80px;
      background: #dbdbdb;
      border-radius: 12px;
      cursor: pointer;
      overflow: hidden;
      transition: transform 0.2s;
    }

    .thumb-item:hover {
      transform: scale(1.05);
    }

    .thumb-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* BAGIAN KANAN - DETAIL TEKS */
    .info-section {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      gap: 25px;
      padding-top: 10px;
    }

    .info-section h1 {
      font-size: 32px;
      font-weight: bold;
      color: #000;
    }

    .info-section .price {
      font-size: 24px;
      font-weight: 500;
      color: #333;
    }

    .info-section .condition {
      font-size: 22px;
      color: #000;
    }

    .info-section .description {
      font-size: 22px;
      color: #000;
      line-height: 1.5;
    }

    /* ACTION BUTTONS (TOMBOL DI BAWAH) */
    .action-buttons {
      display: flex;
      flex-direction: column;
      gap: 15px;
      width: 100%;
    }

    .btn {
      width: 100%;
      padding: 16px;
      font-size: 18px;
      font-weight: bold;
      border: none;
      border-radius: 40px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: all 0.2s;
    }

    .btn-cart {
      background: #4da6ff;
      color: white;
      box-shadow: 0 4px 10px rgba(77, 166, 255, 0.3);
    }

    .btn-cart:hover {
      background: #2b8ff5;
    }

    .btn-buy {
      background: white;
      color: #000;
      border: 1px solid #ddd;
      box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .btn-buy:hover {
      background: #f5f5f5;
    }

    /* Responsive untuk layar tablet/hp */
    @media (max-width: 768px) {
      .main-content {
        flex-direction: column;
      }
      .gallery-section {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<?php
// Menangkap ID produk dari URL, jika tidak ada default ke produk id 1
$id_produk = isset($_GET['id']) ? $_GET['id'] : 1;

// Simulasi data produk statis dari database
$database_produk = [
    1 => [
        "nama" => "Denim Cardigan Premium",
        "harga" => "Rp 150.000",
        "harga_angka" => 150000,
        "kondisi" => "Kondisi: 9/10 (Sangat Bagus)",
        "deskripsi" => "Deskripsi: Bahan denim tebal berkualitas tinggi, warna masih pekat, tidak ada sobek atau cacat baju. Siap pakai untuk nongkrong.",
        "gambar" => "https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=500"
    ],
    2 => [
        "nama" => "Vintage Sweatshirt White",
        "harga" => "Rp 75.000",
        "harga_angka" => 75000,
        "kondisi" => "Kondisi: 8.5/10 (Good Condition)",
        "deskripsi" => "Deskripsi: Crewneck warna putih bersih, karet lengan masih kencang dan nyaman digunakan seharian.",
        "gambar" => "https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=500"
    ],
    3 => [
        "nama" => "Kemeja Putih Formal Thrift",
        "harga" => "Rp 50.000",
        "harga_angka" => 50000,
        "kondisi" => "Kondisi: 9/10 (Like New)",
        "deskripsi" => "Deskripsi: Kemeja formal katun, bahan adem dan mudah disetrika. Cocok untuk kuliah atau magang.",
        "gambar" => "https://images.unsplash.com/photo-1603252109303-2751441dd157?w=500"
    ],
    4 => [
        "nama" => "Vintage Black T-Shirt",
        "harga" => "Rp 120.000",
        "harga_angka" => 120000,
        "kondisi" => "Kondisi: 9.5/10 (Excellent)",
        "deskripsi" => "Deskripsi: Kaos hitam pudar estetik khas vintage art. Bahan katun combed jadul tebal dan nyaman.",
        "gambar" => "https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=500"
    ],
    5 => [
        "nama" => "Baju Motif Flanel Oversize",
        "harga" => "Rp 80.000",
        "harga_angka" => 80000,
        "kondisi" => "Kondisi: 8/10",
        "deskripsi" => "Deskripsi: Kemeja flanel oversize motif kotak-kotak modern. Sempurna dijadikan sebagai outer busana casual.",
        "gambar" => "https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=500"
    ],
    6 => [
        "nama" => "Kaos Putih Polos Oversize",
        "harga" => "Rp 40.000",
        "harga_angka" => 40000,
        "kondisi" => "Kondisi: 9/10",
        "deskripsi" => "Deskripsi: Kaos basic oversize putih bersih, kerah tebal anti melar. Sangat trendy.",
        "gambar" => "https://images.unsplash.com/photo-1554568218-0f1715e72254?w=500"
    ]
];

// Ambil data spesifik berdasarkan ID produk yang diklik
$produk = isset($database_produk[$id_produk]) ? $database_produk[$id_produk] : $database_produk[1];
?>

<div class="detail-container">
  
  <a href="dashboard.php" class="back-btn">
    <i class="fa-solid fa-arrow-left"></i> Kembali
  </a>

  <div class="main-content">
    
    <div class="gallery-section">
      <div class="main-img-wrapper">
        <img src="<?php echo $produk['gambar']; ?>" alt="Gambar Utama">
      </div>
      <div class="thumbnail-list">
        <div class="thumb-item"><img src="<?php echo $produk['gambar']; ?>"></div>
        <div class="thumb-item"><img src="<?php echo $produk['gambar']; ?>"></div>
        <div class="thumb-item"><img src="<?php echo $produk['gambar']; ?>"></div>
      </div>
    </div>

    <div class="info-section">
      <h1 id="prod-name"><?php echo $produk['nama']; ?></h1>
      <div class="price" id="prod-price"><?php echo $produk['harga']; ?></div>
      <div class="condition"><?php echo $produk['kondisi']; ?></div>
      <div class="description"><?php echo $produk['deskripsi']; ?></div>
    </div>

  </div>

  <div class="action-buttons">
    <button class="btn btn-cart" onclick="tambahKeKeranjang()"><i class="fa-solid fa-plus"></i> Tambahkan ke keranjang</button>
    <button class="btn btn-buy" onclick="beliSekarang()">Beli Sekarang</button>
  </div>

</div>

<script>
  // Membuat objek data produk dari PHP ke JavaScript
  const produkSekarang = {
    id: <?php echo $id_produk; ?>,
    nama: "<?php echo $produk['nama']; ?>",
    harga: "<?php echo $produk['harga']; ?>",
    harga_angka: <?php echo $produk['harga_angka']; ?>,
    gambar: "<?php echo $produk['gambar']; ?>"
  };

  // Fungsi Fitur Tambah Keranjang
  function tambahKeKeranjang() {
    // Ambil data keranjang lama dari memori browser (jika sudah ada)
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
    
    // Masukkan produk saat ini ke dalam array daftar keranjang
    keranjang.push(produkSekarang);
    
    // Simpan kembali array yang baru ke dalam memori browser
    localStorage.setItem('keranjang', JSON.stringify(keranjang));
    
    alert('Produk "' + produkSekarang.nama + '" berhasil ditambahkan ke keranjang belanja Anda!');
  }

  // Fungsi Fitur Beli Sekarang
  function beliSekarang() {
    // Otomatis masukkan produk ke keranjang dulu
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
    keranjang.push(produkSekarang);
    localStorage.setItem('keranjang', JSON.stringify(keranjang));
    
    // Langsung arahkan (redirect) pengguna menuju halaman pembayaran / keranjang
    window.location.href = 'keranjang.php';
  }
</script>

</body>
</html>