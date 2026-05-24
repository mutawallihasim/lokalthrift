<?php
$error = $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['identifier'] ?? '';
    $password   = $_POST['password']   ?? '';

    if (!$identifier || !$password)
        $error = 'Email/Username dan password harus diisi.';
    elseif (strlen($password) < 8)
        $error = 'Password minimal 8 karakter.';
    else
        $success = 'Login berhasil! Selamat datang kembali.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokalThrift – Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page" id="page">
    <div class="card card-slide-right">

        <div class="logo-area" style="gap:6px; margin-bottom:16px;">
            <img src="Logo.svg" alt="LokalThrift" style="width:260px; height:88px; object-fit:contain;">
            <h1 class="card-title" style="margin-top:2px;">Selamat Datang Kembali</h1>
            <p class="card-sub" style="margin-bottom:0;">Masuk untuk melanjutkan perjalanan thrift-mu.</p>
        </div>

        <?php if ($error):   ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

        <form method="POST">
            <div class="field">
                <label>Email / Username</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    <input type="text" name="identifier" placeholder="masukkan email atau username" value="<?= htmlspecialchars($_POST['identifier'] ?? '') ?>">
                </div>
            </div>

            <div class="field">
                <label>Password</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <input type="password" id="pw" name="password" placeholder="masukkan password">
                    <button type="button" class="toggle-pw" onclick="togglePw('pw','eye')">
                        <svg id="eye" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            <div class="meta-row">
                <div class="remember">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="forgot_password.php" class="forgot-link" id="toForgot">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-primary">Login</button>
        </form>

        <div class="divider">atau masuk dengan</div>

        <button class="btn-social">
            <svg viewBox="0 0 48 48"><path fill="#4285F4" d="M46.5 24.5c0-1.5-.1-3-.4-4.5H24v8.5h12.7c-.6 3-2.3 5.5-4.8 7.2v6h7.7c4.5-4.1 7-10.2 7-17.2z"/><path fill="#34A853" d="M24 48c6.5 0 11.9-2.1 15.9-5.8l-7.7-6c-2.2 1.5-4.9 2.3-8.2 2.3-6.3 0-11.6-4.2-13.5-9.9H2.6v6.2C6.6 42.8 14.7 48 24 48z"/><path fill="#FBBC04" d="M10.5 28.6c-.5-1.5-.8-3-.8-4.6s.3-3.1.8-4.6v-6.2H2.6C1 16.3 0 20 0 24s1 7.7 2.6 10.8l7.9-6.2z"/><path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.5l6.8-6.8C35.9 2.1 30.4 0 24 0 14.7 0 6.6 5.2 2.6 13.2l7.9 6.2C12.4 13.7 17.7 9.5 24 9.5z"/></svg>
            Login dengan Google
        </button>
        <button class="btn-social">
            <svg viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#1877F2"/><path fill="#fff" d="M33 24h-6v18h-6V24h-4v-6h4v-3.5C21 11.4 22.9 9 28 9h5v6h-3c-1.1 0-2 .9-2 2v1h5l-1 6z"/></svg>
            Login dengan Facebook
        </button>

        <div class="switch-link">
            Belum punya akun? <a href="register.php" id="toRegister">Daftar di sini</a>
        </div>
    </div>

    <div class="bottom-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Aman <span class="dot"></span> Cepat <span class="dot"></span> Terpercaya
    </div>
</div>

<script>
function togglePw(id, eyeId) {
    const i = document.getElementById(id), e = document.getElementById(eyeId);
    i.type = i.type === 'password' ? 'text' : 'password';
    e.innerHTML = i.type === 'text'
        ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
}
document.getElementById('toRegister').addEventListener('click', function(e) {
    e.preventDefault();
    const href = this.href;
    document.getElementById('page').classList.add('page-leave-right');
    setTimeout(() => location.href = href, 400);
});
document.getElementById('toForgot').addEventListener('click', function(e) {
    e.preventDefault();
    const href = this.href;
    document.getElementById('page').classList.add('page-leave-left');
    setTimeout(() => location.href = href, 400);
});
</script>
</body>
</html>