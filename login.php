<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login LokalThrift</title>

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

    .login-card{
      width:320px;
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

    .login-card h2{
      color:#4da6ff;
      margin-bottom:25px;
    }

    .login-card input{
      width:100%;
      padding:12px;
      margin:10px 0;
      border:none;
      border-radius:25px;
      background:#f3f3f3;
      outline:none;
    }

    .forgot{
      display:block;
      margin:10px 0;
      font-size:14px;
      color:gray;
      text-decoration:none;
    }

    .login-card button{
      width:100%;
      padding:12px;
      border:none;
      border-radius:25px;
      background:#5bbcff;
      color:white;
      font-size:16px;
      cursor:pointer;
      transition:0.3s;
    }

    .login-card button:hover{
      background:#349eff;
    }

    .register{
      margin-top:20px;
      font-size:14px;
    }

    .register a{
      color:#349eff;
      text-decoration:none;
      font-weight:bold;
    }

  </style>
</head>

<body>

<div class="login-card">

  <div class="logo">☁ LokalThrift</div>

  <h2>Login</h2>

  <form action="dashboard.php">
    <input type="text" placeholder="Email / Username" required>
    
    <input type="password" placeholder="Password" required>

    <a href="#" class="forgot">Forgot Password?</a>

    <button type="submit">Login</button>
  </form>

  <div class="register">
    Belum punya akun?
    <a href="#">Daftar</a>
  </div>

</div>

</body>
</html>