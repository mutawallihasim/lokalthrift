<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pembayaran - LokalThrift</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f5f7fb;
}

.container{
    width:90%;
    max-width:1200px;
    margin:40px auto;
}

/* STEP */

.steps{
    display:flex;
    justify-content:space-between;
    margin-bottom:40px;
}

.step{
    flex:1;
    text-align:center;
    position:relative;
}

.step::after{
    content:'';
    position:absolute;
    width:100%;
    height:2px;
    background:#d9d9d9;
    top:17px;
    left:50%;
    z-index:-1;
}

.step:last-child::after{
    display:none;
}

.circle{
    width:35px;
    height:35px;
    border-radius:50%;
    background:#2563eb;
    color:white;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:bold;
}

.step p{
    margin-top:8px;
    font-size:14px;
}

.content{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:25px;
}

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 2px 15px rgba(0,0,0,.06);
}

.title{
    font-size:22px;
    margin-bottom:25px;
}

/* PAYMENT */

.payment-option{
    border:2px solid #e5e7eb;
    border-radius:12px;
    padding:18px;
    margin-bottom:15px;
    cursor:pointer;
    transition:.2s;
}

.payment-option:hover{
    border-color:#2563eb;
}

.payment-option input{
    margin-right:10px;
}

.logo{
    font-weight:bold;
    font-size:18px;
}

.desc{
    color:#666;
    margin-top:5px;
    font-size:14px;
}

.summary-item{
    display:flex;
    justify-content:space-between;
    margin-bottom:15px;
}

.total{
    border-top:1px solid #ddd;
    padding-top:15px;
    margin-top:15px;
    font-size:20px;
    font-weight:bold;
}

.btn{
    width:100%;
    border:none;
    padding:15px;
    border-radius:10px;
    margin-top:20px;
    background:#2563eb;
    color:white;
    font-size:16px;
    cursor:pointer;
}

.btn:hover{
    background:#1d4ed8;
}

.back{
    text-decoration:none;
    display:inline-block;
    margin-bottom:20px;
    color:#2563eb;
}

.info-box{
    background:#eef4ff;
    border-left:4px solid #2563eb;
    padding:15px;
    border-radius:10px;
    margin-top:20px;
}

.info-box p{
    font-size:14px;
    color:#555;
}

@media(max-width:768px){

.content{
    grid-template-columns:1fr;
}

}

</style>
</head>
<body>

<div class="container">

<a href="ringkasan.php" class="back">
← Kembali
</a>

<div class="steps">

<div class="step">
<div class="circle">✓</div>
<p>Alamat</p>
</div>

<div class="step">
<div class="circle">✓</div>
<p>Pengiriman</p>
</div>

<div class="step">
<div class="circle">✓</div>
<p>Ringkasan</p>
</div>

<div class="step">
<div class="circle">4</div>
<p>Pembayaran</p>
</div>

</div>

<form action="berhasil.php" method="post">

<div class="content">

<!-- KIRI -->

<div class="card">

<h2 class="title">Metode Pembayaran</h2>

<label class="payment-option">

<input type="radio"
name="payment"
value="BCA"
required>

<span class="logo">
🏦 Transfer BCA
</span>

<div class="desc">
Transfer ke rekening BCA.
</div>

</label>

<label class="payment-option">

<input type="radio"
name="payment"
value="BRI">

<span class="logo">
🏦 Transfer BRI
</span>

<div class="desc">
Transfer ke rekening BRI.
</div>

</label>

<label class="payment-option">

<input type="radio"
name="payment"
value="DANA">

<span class="logo">
💳 DANA
</span>

<div class="desc">
Bayar menggunakan saldo DANA.
</div>

</label>

<label class="payment-option">

<input type="radio"
name="payment"
value="OVO">

<span class="logo">
💳 OVO
</span>

<div class="desc">
Bayar menggunakan saldo OVO.
</div>

</label>

<div class="info-box">
<p>
Setelah pembayaran berhasil,
pesanan akan diproses oleh penjual dan
status pengiriman dapat dilihat pada menu
<strong>Pesanan Saya</strong>.
</p>
</div>

</div>

<!-- KANAN -->

<div class="card">

<h3>Ringkasan Pembayaran</h3>

<br>

<div class="summary-item">
<span>Vintage Denim Jacket</span>
<span>Rp120.000</span>
</div>

<div class="summary-item">
<span>Ongkir</span>
<span>Rp15.000</span>
</div>

<div class="summary-item total">
<span>Total</span>
<span>Rp135.000</span>
</div>

<button class="btn">
Bayar Sekarang
</button>

</div>

</div>

</form>

</div>

</body>
</html>