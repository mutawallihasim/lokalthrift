<<<<<<< HEAD
<?php
// Pastikan tidak ada spasi atau karakter apa pun di atas tag PHP ini
?>
=======
>>>>>>> e28094c53a4a97db10a7b29eae5e23a3831ca819
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
  <title>Dashboard LokalThrift - Full Screen</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Helvetica Neue', Arial, sans-serif;
    }

    body {
      background: #eef5fc; 
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .dashboard {
      width: 100%;
      max-width: 1400px; 
      margin: 0 auto;
      padding: 30px 40px 120px 40px; 
      flex: 1;
    }

    /* HEADER */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .header .title {
      font-size: 24px;
      font-weight: bold;
      color: #9db2c6;
    }

    .header .notif-btn {
      font-size: 26px;
      color: #000;
      cursor: pointer;
    }

    /* SEARCH BOX */
    .search-box {
      position: relative;
      margin-bottom: 25px;
      width: 100%;
    }

    .search-box input {
      width: 100%;
      padding: 16px 16px 16px 55px;
      border: 1px solid #d4e3f3;
      border-radius: 40px;
      background: white;
      outline: none;
      font-size: 16px;
      color: #333;
      box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .search-box i {
      position: absolute;
      left: 22px;
      top: 50%;
      transform: translateY(-50%);
      color: #000;
      font-size: 18px;
    }

    /* KATEGORI */
    .kategori {
      display: flex;
      gap: 15px;
      overflow-x: auto;
      margin-bottom: 30px;
      padding-bottom: 5px;
    }

    .kategori::-webkit-scrollbar {
      display: none;
    }

    .kategori .item {
      padding: 12px 35px;
      background: #a9d4f9;
      color: #000;
      border-radius: 30px;
      font-size: 16px;
      font-weight: bold;
      white-space: nowrap;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      transition: all 0.2s;
    }

    .kategori .item:hover {
      background: #2a85ff;
      color: white;
    }

    /* BANNER */
    .banner {
      background: #bce3ff;
      border-radius: 20px;
      padding: 30px 50px;
      margin-bottom: 35px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .banner-text {
      max-width: 65%;
    }

    .banner-text .tag {
      font-size: 14px;
      font-weight: bold;
      text-transform: uppercase;
      color: #333;
    }

    .banner-text h1 {
      font-size: 32px;
      font-weight: 800;
      margin: 8px 0;
      color: #000;
      line-height: 1.2;
    }

    .banner-text p {
      font-size: 16px;
      color: #444;
      margin-bottom: 15px;
    }

    .banner-text .btn-belanja {
      display: inline-block;
      padding: 10px 24px;
      background: #2a85ff;
      color: white;
      font-size: 14px;
      font-weight: bold;
      border-radius: 25px;
      text-decoration: none;
    }

    .banner-img-container {
      position: relative;
      width: 30%;
      height: 140px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .banner-img {
      max-height: 150px;
      object-fit: contain;
    }

    .badge-sale {
      position: absolute;
      right: 10px;
      bottom: -10px;
      background: #fff000;
      color: #000;
      font-size: 12px;
      font-weight: 900;
      padding: 10px;
      border-radius: 50%;
      transform: rotate(-15deg);
      border: 1.5px dashed #000;
      text-align: center;
      line-height: 1.1;
    }

    /* SECTION PRODUK */
    .section-container {
      display: flex;
      gap: 24px;
      margin-bottom: 30px;
    }

    .block-produk {
      flex: 1;
      background: white;
      border-radius: 20px;
      padding: 24px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .block-title {
      font-size: 18px;
      font-weight: bold;
      color: #000;
      margin-bottom: 20px;
    }

    .grid-produk {
      display: grid;
      grid-template-columns: repeat(3, 1fr); 
      gap: 20px;
    }

    /* KARTU PRODUK SEBAGAI LINK */
    .card-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      text-decoration: none; 
      color: inherit; 
      cursor: pointer;
      transition: transform 0.2s;
    }

    .card-item:hover {
      transform: translateY(-5px);
    }

    .img-wrapper {
      width: 100%;
      background: #f7f9fa;
      border-radius: 16px;
      padding: 0; /* Diubah jadi 0 agar gambar memenuhi kotak abu-abu */
      display: flex;
      justify-content: center;
      align-items: center;
      aspect-ratio: 1 / 1;
      overflow: hidden; /* Memastikan sudut gambar terpotong rapi */
    }

    /* MEMBUAT UKURAN GAMBAR RATA DAN KONSISTEN */
    .card-item img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Gambar dipotong otomatis secara proporsional agar tidak gepeng */
    }

    .card-item .item-name {
      font-size: 14px;
      color: #333;
      margin-top: 10px;
      width: 100%;
      text-align: left;
    }

    .card-item .item-price {
      font-size: 14px;
      font-weight: bold;
      color: #000;
      width: 100%;
      text-align: left;
    }

    /* BOTTOM NAVBAR */
    .navbar {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      width: 100%;
      background: white;
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 15px 0;
      border-top-left-radius: 25px;
      border-top-right-radius: 25px;
      box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
      z-index: 999;
    }

    .nav-item {
      text-align: center;
      font-size: 14px;
      font-weight: bold;
      color: #000; 
      text-decoration: none; 
      cursor: pointer;
      flex: 1;
      transition: color 0.2s;
    }

    .nav-item i {
      font-size: 22px;
      margin-bottom: 6px;
      display: inline-block;
    }

    .nav-item:hover {
      color: #2a85ff;
    }

    .nav-item.active {
      color: #000;
    }

    @media (max-width: 768px) {
      .section-container {
        flex-direction: column;
      }
    }
  </style>
</head>
=======
  <title>Dashboard LokalThrift</title>

  <style>

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:Arial, sans-serif;
    }

    body{
      background:#f2f2f2;
      display:flex;
      justify-content:center;
    }

    .dashboard{
      width:100%;
      min-height:100vh;
      background:white;
      padding:15px;
      position:relative;
    }

    /* HEADER */
    .header{
      display:flex;
      justify-content: center;
      align-items:center;
      margin-bottom:20px;
    }

    .header h2{
      color:#4da6ff;
      font-size:35px;
    }

    .notif{
      font-size:22px;
      cursor:pointer;
      position: relative;
      left: 34%;
    }

    /* SEARCH */
    .search-box input{
      width:100%;
      padding:12px;
      border:none;
      border-radius:25px;
      background:#f3f3f3;
      outline:none;
      margin-bottom:20px;
    }

    /* KATEGORI */
    .kategori{
      display:flex;
      gap:10px;
      overflow-x:auto;
      margin-bottom:20px;
    }

    .kategori::-webkit-scrollbar{
      display:none;
    }

    .item{
      min-width:19%;
      background:#dff3ff;
      padding:10px;
      border-radius:20px;
      text-align:center;
      font-size:14px;
      cursor:pointer;
      transition:0.3s;
    }

    .item:hover{
      background:#4da6ff;
      color:white;
    }

    /* BANNER */
    .banner{
      background:linear-gradient(to right,#dff3ff,#ffffff);
      padding:20px;
      border-radius:20px;
      margin-bottom:25px;
    }

    .banner p{
      font-size:14px;
    }

    .banner h1{
      font-size:32px;
      margin:10px 0;
    }

    .banner h2{
      font-size:22px;
    }

    .banner span{
      color:#349eff;
      font-weight:bold;
    }

    /* PRODUK */
    .produk-header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:15px;
    }

    .produk-header p{
      color:#349eff;
      cursor:pointer;
    }

    .produk-container{
      display:flex;
      gap:15px;
      flex-wrap:wrap;
    }

    .card{
      width:48%;
      height: 500px;
      background:#fafafa;
      border-radius:15px;
      padding:10px;
      box-shadow:0 2px 5px rgba(0,0,0,0.1);
      transition:0.3s;
    }

    .card:hover{
      transform:translateY(-5px);
    }

    .card img{
      width:100%;
      height:300px;
      object-fit:cover;
      border-radius:10px;
    }

    .card h4{
      margin-top:10px;
      font-size:15px;
    }

    .card p{
      margin-top:5px;
      color:#555;
    }

    /* NAVBAR */
    .navbar{
      position:fixed;
      bottom:0;
      width:100%;
      background:white;
      display:flex;
      justify-content:space-around;
      padding:12px;
      border-top:1px solid #ddd;
    }

    .nav-item{
      text-align:center;
      font-size:14px;
      cursor:pointer;
      transition:0.3s;
    }

    .nav-item:hover{
      color:#349eff;
    }

  </style>
</head>

>>>>>>> e28094c53a4a97db10a7b29eae5e23a3831ca819
<body>

<div class="dashboard">

<<<<<<< HEAD
  <div class="header">
    <div class="title">Selamat Datang di LokalThrift</div>
    <div class="notif-btn"><i class="fa-regular fa-bell"></i></div>
  </div>

  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Cari produk thirft...">
  </div>

=======
  <!-- HEADER -->
  <div class="header">
    <h2>☁ LokalThrift</h2>
    <div class="notif">🔔</div>
  </div>

  <!-- SEARCH -->
  <div class="search-box">
    <input type="text" placeholder="Cari produk thrift...">
  </div>

  <!-- KATEGORI -->
>>>>>>> e28094c53a4a97db10a7b29eae5e23a3831ca819
  <div class="kategori">
    <div class="item">Casual</div>
    <div class="item">Vintage</div>
    <div class="item">Sport</div>
    <div class="item">Denim</div>
<<<<<<< HEAD
    <div class="item">Outwear</div>
  </div>

  <div class="banner">
    <div class="banner-text">
      <p class="tag">Diskon Spesial</p>
      <h1>Thrift Favorit Harga Hemat!</h1>
      <p>Diskon hingga 50% + Gratis Ongkir</p>
      <a href="#" class="btn-belanja">Belanja Sekarang</a>
    </div>
    <div class="banner-img-container">
      <img class="banner-img" src="https://images.unsplash.com/photo-1540221652346-e5dd6b50f3e7?w=300" alt="Promo">
      <div class="badge-sale">sale<br>50%<br>off</div>
    </div>
  </div>

  <div class="section-container">
    
    <div class="block-produk">
      <div class="block-title">Produk Terbaru</div>
      <div class="grid-produk">
        
        <a href="detail.php?id=1" class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=200" alt="Produk 1">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp150.000</div>
        </a>

        <a href="detail.php?id=2" class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=200" alt="Produk 2">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp75.000</div>
        </a>

        <a href="detail.php?id=3" class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1603252109303-2751441dd157?w=200" alt="Produk 3">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp50.000</div>
        </a>

      </div>
    </div>

    <div class="block-produk">
      <div class="block-title">Rekomendasi</div>
      <div class="grid-produk">
        
        <a href="detail.php?id=4" class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=200" alt="Produk 4">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp120.000</div>
        </a>

        <a href="detail.php?id=5" class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=200" alt="Produk 5">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp80.000</div>
        </a>

        <a href="detail.php?id=6" class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1554568218-0f1715e72254?w=200" alt="Produk 6">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp40.000</div>
        </a>

      </div>
=======
    <div class="item">Outerwear</div>
  </div>

  <!-- BANNER -->
  <div class="banner">
    <p>Promo Besar</p>
    <h1>Spring Sale</h1>
    <h2>Up to <span>50% OFF</span></h2>
  </div>

  <!-- PRODUK -->
  <div class="produk-header">
    <h3>Categories</h3>
    <p>More ></p>
  </div>

  <div class="produk-container">

    <div class="card">
      <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500" alt="">
      <h4>Denim Cardigan</h4>
      <p>Rp 12.000</p>
    </div>

    <div class="card">
      <img src="https://images.unsplash.com/photo-1523398002811-999ca8dec234?w=500" alt="">
      <h4>Vintage Leather</h4>
      <p>Rp 253.000</p>
    </div>

    <div class="card">
      <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=500" alt="">
      <h4>Hoodie Oversize</h4>
      <p>Rp 89.000</p>
    </div>

    <div class="card">
      <img src="https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=500" alt="">
      <h4>Vintage Jacket</h4>
      <p>Rp 150.000</p>
>>>>>>> e28094c53a4a97db10a7b29eae5e23a3831ca819
    </div>

  </div>

</div>

<<<<<<< HEAD
<div class="navbar">
  <a href="dashboard.php" class="nav-item active">
    <i class="fa-solid fa-house"></i><br>Beranda
  </a>
  <a href="order.php" class="nav-item">
    <i class="fa-solid fa-box"></i><br>Order
  </a>
  <a href="keranjang.php" class="nav-item">
    <i class="fa-solid fa-cart-shopping"></i><br>Keranjang
  </a>
  <a href="akun.php" class="nav-item">
    <i class="fa-solid fa-user"></i><br>Akun
  </a>
=======
<!-- NAVBAR -->
<div class="navbar">
  <div class="nav-item">🏠<br>Beranda</div>
  <div class="nav-item">🛒<br>Keranjang</div>
  <div class="nav-item">👤<br>Akun</div>
>>>>>>> e28094c53a4a97db10a7b29eae5e23a3831ca819
</div>

</body>
</html>