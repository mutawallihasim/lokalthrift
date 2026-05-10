<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<body>

<div class="dashboard">

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
  <div class="kategori">
    <div class="item">Casual</div>
    <div class="item">Vintage</div>
    <div class="item">Sport</div>
    <div class="item">Denim</div>
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
    </div>

  </div>

</div>

<!-- NAVBAR -->
<div class="navbar">
  <div class="nav-item">🏠<br>Beranda</div>
  <div class="nav-item">🛒<br>Keranjang</div>
  <div class="nav-item">👤<br>Akun</div>
</div>

</body>
</html>