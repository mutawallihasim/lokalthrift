<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout - LokalThrift</title>

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
    max-width:1200px;
    margin:40px auto;
    padding:20px;
}

.header{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:30px;
}

.header a{
    text-decoration:none;
    color:#333;
}

.steps{
    display:flex;
    justify-content:space-between;
    align-items:center;
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
    top:18px;
    left:55%;
    width:90%;
    height:2px;
    background:#dcdcdc;
    z-index:-1;
}

.step:last-child::after{
    display:none;
}

.circle{
    width:35px;
    height:35px;
    border-radius:50%;
    background:#dcdcdc;
    color:white;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
}

.active .circle{
    background:#2563eb;
}

.step p{
    margin-top:8px;
    font-size:14px;
}

.content{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:25px;
}

.card{
    background:white;
    border-radius:12px;
    padding:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.card h3{
    margin-bottom:15px;
}

.address-box{
    border:1px solid #ddd;
    padding:15px;
    border-radius:10px;
}

.address-box h4{
    margin-bottom:8px;
}

.address-box p{
    color:#666;
    line-height:1.6;
}

.change{
    color:#2563eb;
    text-decoration:none;
    float:right;
}

.shipping-option{
    border:1px solid #ddd;
    border-radius:10px;
    padding:15px;
    margin-bottom:12px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    cursor:pointer;
}

.shipping-option:hover{
    border-color:#2563eb;
}

.shipping-option input{
    margin-right:10px;
}

.price{
    color:#2563eb;
    font-weight:bold;
}

.add-address{
    display:block;
    margin-top:15px;
    text-decoration:none;
    color:#2563eb;
}

.footer{
    margin-top:30px;
    text-align:right;
}

.btn{
    background:#2563eb;
    color:white;
    border:none;
    padding:14px 35px;
    border-radius:8px;
    cursor:pointer;
    font-size:15px;
}

.btn:hover{
    background:#1d4ed8;
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

<div class="header">
<a href="keranjang.php">←</a>
<h2>Checkout</h2>
</div>

<div class="steps">

<div class="step active">
<div class="circle">1</div>
<p>Alamat</p>
</div>

<div class="step">
<div class="circle">2</div>
<p>Pengiriman</p>
</div>

<div class="step">
<div class="circle">3</div>
<p>Ringkasan</p>
</div>

<div class="step">
<div class="circle">4</div>
<p>Pembayaran</p>
</div>

</div>

<form action="ringkasan.php" method="POST">

<div class="content">

<div class="card">

<h3>Alamat Pengiriman</h3>

<div class="address-box">

<a href="#" class="change">Ubah</a>

<h4>Rumah</h4>

<p>
Jl. Mawar No.12<br>
Kec. Coblong<br>
Kota Bandung<br>
Jawa Barat 40132
</p>

</div>

<a href="#" class="add-address">
+ Tambah Alamat Baru
</a>

</div>

<div class="card">

<h3>Metode Pengiriman</h3>

<label class="shipping-option">

<div>
<input type="radio"
name="pengiriman"
value="JNE Reguler"
checked>

JNE Reguler (2-3 hari)
</div>

<div class="price">
Rp 15.000
</div>

</label>

<label class="shipping-option">

<div>
<input type="radio"
name="pengiriman"
value="JNE Express">

JNE Express (1-2 hari)
</div>

<div class="price">
Rp 25.000
</div>

</label>

<label class="shipping-option">

<div>
<input type="radio"
name="pengiriman"
value="SiCepat Reguler">

SiCepat Reguler (2-3 hari)
</div>

<div class="price">
Rp 13.000
</div>

</label>

</div>

</div>

<div class="footer">
<button type="submit" class="btn">
Lanjutkan
</button>
</div>

</form>

</div>

</body>
</html>