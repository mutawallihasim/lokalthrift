<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar LokalThrift</title>

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
      align-items:center;
      height:100vh;
    }

    .register-card{
      width:340px;
      background:white;
      padding:40px 25px;
      border-radius:25px;
      box-shadow:0 4px 10px rgba(0,0,0,0.1);
      text-align:center;
    }

    .logo{
      font-size:30px;
      color:#4da6ff;
      font-weight:bold;
      margin-bottom:10px;
    }

    .register-card h2{
      color:#4da6ff;
      margin-bottom:25px;
    }

    .register-card input{
      width:100%;
      padding:12px;
      margin:10px 0;
      border:none;
      border-radius:25px;
      background:#f3f3f3;
      outline:none;
    }

    .register-card select{
      width:100%;
      padding:12px;
      margin:10px 0;
      border:none;
      border-radius:25px;
      background:#f3f3f3;
      outline:none;
    }

    .register-card button{
      width:100%;
      padding:12px;
      border:none;
      border-radius:25px;
      background:#5bbcff;
      color:white;
      font-size:16px;
      cursor:pointer;
      margin-top:15px;
      transition:0.3s;
    }

    .register-card button:hover{
      background:#349eff;
    }

    .login-link{
      margin-top:20px;
      font-size:14px;
    }

    .login-link a{
      color:#349eff;
      text-decoration:none;
      font-weight:bold;
    }

  </style>
</head>

<body>

<div class="register-card">

  <div class="logo">☁ LokalThrift</div>

  <h2>Daftar Akun</h2>

  <form action="login.html">

    <input type="text" placeholder="Nama Lengkap" required>

    <input type="email" placeholder="Email" required>

    <input type="text" placeholder="Username" required>

    <input type="password" placeholder="Password" required>

    <input type="password" placeholder="Konfirmasi Password" required>

    <select required>
      <option value="">Pilih Role</option>
      <option>Pembeli</option>
      <option>Penjual</option>
    </select>

    <button type="submit">Daftar</button>

  </form>

  <div class="login-link">
    Sudah punya akun?
    <a href="login.html">Login</a>
  </div>

</div>

</body>
</html>