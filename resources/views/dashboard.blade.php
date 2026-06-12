<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - LokalThrift</title>
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
      background-color: #f4f8fc;
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
      font-weight: 600;
    }

    .nav-actions a:hover {
      color: #2a85ff;
    }

    /* MAIN CONTENT WRAPPER */
    .dashboard-wrapper {
      width: 90%;
      max-width: 1200px;
      margin: 40px auto;
      flex: 1;
    }

    .welcome-text {
      margin-bottom: 30px;
    }

    .welcome-text h2 {
      font-size: 26px;
      font-weight: 700;
      color: #0d1c2e;
    }

    .welcome-text p {
      font-size: 14px;
      color: #7d8c9e;
      margin-top: 4px;
    }

    /* KATALOG GRID PRODUK */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 25px;
    }

    /* KARTU PRODUK */
    .product-card {
      background-color: #ffffff;
      border: 1px solid #eef2f7;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.01);
      display: flex;
      flex-direction: column;
      text-decoration: none;
      color: inherit;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(42, 133, 255, 0.06);
    }

    .card-img-wrapper {
      width: 100%;
      aspect-ratio: 1 / 1;
      background-color: #f8fbfe;
      overflow: hidden;
    }

    .card-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .card-info {
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      flex: 1;
    }

    .card-title {
      font-size: 15px;
      font-weight: 600;
      color: #0d1c2e;
      line-height: 1.4;
      /* Membatasi teks nama produk maksimal 2 baris */
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      height: 42px;
    }

    .card-condition {
      display: inline-block;
      align-self: flex-start;
      padding: 4px 10px;
      background-color: #eef5fc;
      color: #2a85ff;
      font-size: 11px;
      font-weight: 700;
      border-radius: 6px;
    }

    .card-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: auto;
      padding-top: 10px;
    }

    .card-price {
      font-size: 16px;
      font-weight: 800;
      color: #0d1c2e;
    }

    .btn-view-product {
      width: 32px;
      height: 32px;
      background-color: #2a85ff;
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 13px;
    }

    @media (max-width: 600px) {
      .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
      }
      .card-info {
        padding: 12px;
      }
      .card-title {
        font-size: 13px;
        height: 36px;
      }
      .card-price {
        font-size: 14px;
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
      <input type="text" placeholder="Cari pakaian favoritmu...">
    </div>
    <div class="nav-actions">
      <a href="/keranjang"><i class="fa-solid fa-cart-shopping"></i> Keranjang</a>
      <a href="/akun"><i class="fa-regular fa-user"></i> Akun</a>
    </div>
  </div>

  <div class="dashboard-wrapper">
    
    <div class="welcome-text">
      <h2>Selamat Datang di LokalThrift</h2>
      <p>Temukan pakaian vintage pilihan dengan kualitas terbaik dan harga terjangkau</p>
    </div>

    <div class="products-grid">
      
      <a href="/detail?id=1" class="product-card">
        <div class="card-img-wrapper">
          <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=300" alt="Vintage Denim Jacket">
        </div>
        <div class="card-info">
          <div class="card-condition">Excellent Condition</div>
          <div class="card-title">Vintage Denim Jacket Original</div>
          <div class="card-bottom">
            <div class="card-price">Rp 125.000</div>
            <div class="btn-view-product"><i class="fa-solid fa-arrow-right"></i></div>
          </div>
        </div>
      </a>

      <a href="/detail?id=2" class="product-card">
        <div class="card-img-wrapper">
          <img src="https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=300" alt="Crewneck Michigan">
        </div>
        <div class="card-info">
          <div class="card-condition">Very Good</div>
          <div class="card-title">Crewneck Michigan State Vintage Green</div>
          <div class="card-bottom">
            <div class="card-price">Rp 85.000</div>
            <div class="btn-view-product"><i class="fa-solid fa-arrow-right"></i></div>
          </div>
        </div>
      </a>

      <a href="/detail?id=3" class="product-card">
        <div class="card-img-wrapper">
          <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=300" alt="Kemeja Flanel">
        </div>
        <div class="card-info">
          <div class="card-condition">Like New</div>
          <div class="card-title">Kemeja Flanel Casual Motif Kotak</div>
          <div class="card-bottom">
            <div class="card-price">Rp 75.000</div>
            <div class="btn-view-product"><i class="fa-solid fa-arrow-right"></i></div>
          </div>
        </div>
      </a>

    </div>
  </div>

</body>
</html>