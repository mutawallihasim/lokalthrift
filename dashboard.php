<?php
// Pastikan tidak ada spasi atau karakter apa pun di atas tag PHP ini
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    .card-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .img-wrapper {
      width: 100%;
      background: #f7f9fa;
      border-radius: 16px;
      padding: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
      aspect-ratio: 1 / 1;
    }

    .card-item img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
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
      cursor: pointer;
      flex: 1;
      text-decoration: none;
    }

    .nav-item i {
      font-size: 22px;
      margin-bottom: 6px;
      display: inline-block;
    }

    @media (max-width: 768px) {
      .section-container {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

<div class="dashboard">

  <div class="header">
    <div class="title">Selamat Datang</div>
    <div class="notif-btn"><i class="fa-regular fa-bell"></i></div>
  </div>

  <div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" placeholder="Cari produk thirft...">
  </div>

  <div class="kategori">
    <div class="item">Casual</div>
    <div class="item">Vintage</div>
    <div class="item">Sport</div>
    <div class="item">Denim</div>
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
        
        <div class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=200" alt="Produk 1">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp150.000</div>
        </div>

        <div class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=200" alt="Produk 2">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp75.000</div>
        </div>

        <div class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1603252109303-2751441dd157?w=200" alt="Produk 3">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp50.000</div>
        </div>

      </div>
    </div>

    <div class="block-produk">
      <div class="block-title">Rekomendasi</div>
      <div class="grid-produk">
        
        <div class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=200" alt="Produk 4">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp120.000</div>
        </div>

        <div class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=200" alt="Produk 5">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp80.000</div>
        </div>

        <div class="card-item">
          <div class="img-wrapper">
            <img src="https://images.unsplash.com/photo-1554568218-0f1715e72254?w=200" alt="Produk 6">
          </div>
          <div class="item-name">nama</div>
          <div class="item-price">Rp40.000</div>
        </div>

      </div>
    </div>

  </div>

</div>

<div class="navbar">
  <div class="nav-item">
    <i class="fa-solid fa-house"></i><br>Beranda
  </div>
  <div class="nav-item">
    <i class="fa-solid fa-box"></i><br>Order
  </div>
  <div class="nav-item">
    <i class="fa-solid fa-cart-shopping"></i><br>Keranjang
  </div>
  <div class="nav-item">
    <i class="fa-solid fa-user"></i><br>Akun
  </div>
</div>

</body>
</html>