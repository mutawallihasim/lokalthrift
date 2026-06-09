<?php
$error = $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email']            ?? '';
    $username = $_POST['username']         ?? '';
    $password = $_POST['password']         ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';
    $agree    = $_POST['agree']            ?? '';

    if (!$email || !$username || !$password || !$confirm)
        $error = 'Semua field harus diisi.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $error = 'Format email tidak valid.';
    elseif (strlen($password) < 8)
        $error = 'Password minimal 8 karakter.';
    elseif ($password !== $confirm)
        $error = 'Konfirmasi password tidak cocok.';
    elseif (!$agree)
        $error = 'Anda harus menyetujui syarat & ketentuan.';
    else
        $success = 'Akun berhasil dibuat! Silakan login.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokalThrift – Daftar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* PASSWORD STRENGTH */

        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }
        .strength-bar span {
            flex: 1;
            height: 4px;
            border-radius: 99px;
            background: var(--border);
            transition: background .3s;
        }

        .strength-label {
            font-size: 11.5px;
            font-weight: 600;
            margin-top: 5px;
            min-height: 16px;
            transition: color .3s;
        }

        /* weak=1 bar merah, medium=2 bar kuning, strong=3 bar hijau, very-strong=4 bar hijau tua */
        .s-weak   .strength-bar span:nth-child(1)                          { background: #EF4444; }
        .s-medium .strength-bar span:nth-child(1),
        .s-medium .strength-bar span:nth-child(2)                          { background: #F59E0B; }
        .s-strong .strength-bar span:nth-child(1),
        .s-strong .strength-bar span:nth-child(2),
        .s-strong .strength-bar span:nth-child(3)                          { background: #10B981; }
        .s-vstrong .strength-bar span                                       { background: #059669; }

        .s-weak   .strength-label { color: #EF4444; }
        .s-medium .strength-label { color: #F59E0B; }
        .s-strong .strength-label { color: #10B981; }
        .s-vstrong .strength-label { color: #059669; }

        /* PASSWORD SUGGESTION POPOVER */
        .pw-suggest-wrap { position: relative; }

        .pw-suggest {
            display: none;
            position: absolute;
            left: 0; right: 0;
            top: calc(100% + 8px);
            background: #fff;
            border: 1.5px solid var(--uranian);
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(37,99,235,0.13);
            padding: 14px 16px;
            z-index: 100;
            animation: fadeIn .22s ease;
        }
        .pw-suggest.open { display: block; }

        /* arrow caret */
        .pw-suggest::before {
            content: '';
            position: absolute;
            top: -8px; left: 18px;
            width: 14px; height: 14px;
            background: #fff;
            border-left: 1.5px solid var(--uranian);
            border-top: 1.5px solid var(--uranian);
            transform: rotate(45deg);
            border-radius: 2px;
        }

        .pw-suggest-title {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .pw-rules { list-style: none; display: flex; flex-direction: column; gap: 7px; }
        .pw-rules li {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 12.5px;
            color: var(--text-mid);
            transition: color .2s;
        }
        .pw-rules li .rule-icon {
            width: 18px; height: 18px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: background .2s, border-color .2s;
        }
        .pw-rules li .rule-icon svg { width: 10px; height: 10px; stroke: #fff; display: none; }
        .pw-rules li.ok { color: var(--success); }
        .pw-rules li.ok .rule-icon {
            background: var(--success);
            border-color: var(--success);
        }
        .pw-rules li.ok .rule-icon svg { display: block; }

        .pw-suggest-tips {
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid var(--columbia);
            font-size: 11.5px;
            color: var(--text-light);
            line-height: 1.6;
        }
        .pw-suggest-tips strong { color: var(--text-mid); font-weight: 600; }

    </style>
</head>
<body>
<div class="page" id="page">
    <div class="card card-slide-up">

        <div class="logo-area" style="gap:6px; margin-bottom:16px;">
            <img src="Logo.svg" alt="LokalThrift" style="width:260px; height:88px; object-fit:contain;">
            <h1 class="card-title" style="margin-top:2px;">Buat Akun Baru</h1>
            <p class="card-sub" style="margin-bottom:0;">Gabung dan temukan thrift item terbaik<br>di sekitarmu.</p>
        </div>

        <?php if ($error):   ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

        <form method="POST">
            <div class="field">
                <label>Email</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="3"/><path d="m2 7 10 7 10-7"/></svg>
                    <input type="email" name="email" placeholder="contoh@gmail.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
            </div>

            <div class="field">
                <label>Username</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    <input type="text" name="username" placeholder="masukkan username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="field" id="pwField">
                <label>Password</label>
                <div class="pw-suggest-wrap">
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" id="pw1" name="password" placeholder="minimal 8 karakter"
                            oninput="checkStrength(this.value)"
                            onfocus="openSuggest()" onblur="closeSuggest(event)">
                        <button type="button" class="toggle-pw" onclick="togglePw('pw1','eye1')">
                            <svg id="eye1" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>

                    <!-- SUGGESTION POPOVER -->
                    <div class="pw-suggest" id="pwSuggest">
                        <div class="pw-suggest-title">💡 Saran Buat Password Kuat</div>
                        <ul class="pw-rules" id="pwRules">
                            <li id="r-len">
                                <span class="rule-icon"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1,6 4,9 11,2"/></svg></span>
                                Minimal 8 karakter
                            </li>
                            <li id="r-upper">
                                <span class="rule-icon"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1,6 4,9 11,2"/></svg></span>
                                Huruf kapital (A–Z)
                            </li>
                            <li id="r-lower">
                                <span class="rule-icon"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1,6 4,9 11,2"/></svg></span>
                                Huruf kecil (a–z)
                            </li>
                            <li id="r-num">
                                <span class="rule-icon"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1,6 4,9 11,2"/></svg></span>
                                Angka (0–9)
                            </li>
                            <li id="r-sym">
                                <span class="rule-icon"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1,6 4,9 11,2"/></svg></span>
                                Simbol (!@#$%^&*)
                            </li>
                        </ul>
                        <div class="pw-suggest-tips">
                            <strong>Tips:</strong> Hindari nama, tanggal lahir, atau kata umum. Gunakan frasa acak seperti <strong>Kopi#Biru7!</strong> agar mudah diingat tapi sulit ditebak.
                        </div>
                    </div>
                </div>

                <!-- STRENGTH INDICATOR -->
                <div class="strength-bar">
                    <span></span><span></span><span></span><span></span>
                </div>
                <div class="strength-label" id="strengthLabel"></div>
            </div>

            <div class="field">
                <label>Konfirmasi Password</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <input type="password" id="pw2" name="confirm_password" placeholder="ulangi password">
                    <button type="button" class="toggle-pw" onclick="togglePw('pw2','eye2')">
                        <svg id="eye2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            <div class="check-row">
                <input type="checkbox" id="agree" name="agree" value="1" <?= !empty($_POST['agree']) ? 'checked' : '' ?>>
                <label for="agree">Saya setuju dengan <a href="#">syarat &amp; ketentuan</a></label>
            </div>

            <button type="submit" class="btn-primary">Daftar</button>
        </form>

        <div class="divider">atau daftar dengan</div>

        <button class="btn-social">
            <svg viewBox="0 0 48 48"><path fill="#4285F4" d="M46.5 24.5c0-1.5-.1-3-.4-4.5H24v8.5h12.7c-.6 3-2.3 5.5-4.8 7.2v6h7.7c4.5-4.1 7-10.2 7-17.2z"/><path fill="#34A853" d="M24 48c6.5 0 11.9-2.1 15.9-5.8l-7.7-6c-2.2 1.5-4.9 2.3-8.2 2.3-6.3 0-11.6-4.2-13.5-9.9H2.6v6.2C6.6 42.8 14.7 48 24 48z"/><path fill="#FBBC04" d="M10.5 28.6c-.5-1.5-.8-3-.8-4.6s.3-3.1.8-4.6v-6.2H2.6C1 16.3 0 20 0 24s1 7.7 2.6 10.8l7.9-6.2z"/><path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.5l6.8-6.8C35.9 2.1 30.4 0 24 0 14.7 0 6.6 5.2 2.6 13.2l7.9 6.2C12.4 13.7 17.7 9.5 24 9.5z"/></svg>
            Daftar dengan Google
        </button>
        <button class="btn-social">
            <svg viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#1877F2"/><path fill="#fff" d="M33 24h-6v18h-6V24h-4v-6h4v-3.5C21 11.4 22.9 9 28 9h5v6h-3c-1.1 0-2 .9-2 2v1h5l-1 6z"/></svg>
            Daftar dengan Facebook
        </button>

        <div class="switch-link">
            Sudah punya akun? <a href="login.php" id="toLogin">Login di sini</a>
        </div>
    </div>

    <div class="bottom-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Aman <span class="dot"></span> Cepat <span class="dot"></span> Terpercaya
    </div>
</div>

<script>
/* ── SUGGEST POPOVER ── */
function openSuggest() {
    document.getElementById('pwSuggest').classList.add('open');
}
function closeSuggest(e) {
    // delay so clicks inside popover still register
    setTimeout(() => {
        const pop = document.getElementById('pwSuggest');
        if (!pop.contains(document.activeElement))
            pop.classList.remove('open');
    }, 150);
}

function setRule(id, ok) {
    const el = document.getElementById(id);
    if (ok) el.classList.add('ok'); else el.classList.remove('ok');
}

/* ── TOGGLE SHOW/HIDE ── */
function togglePw(id, eyeId) {
    const i = document.getElementById(id), e = document.getElementById(eyeId);
    i.type = i.type === 'password' ? 'text' : 'password';
    e.innerHTML = i.type === 'text'
        ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
}

/* ── STRENGTH CHECKER ── */
function checkStrength(val) {
    const field = document.getElementById('pwField');
    const label = document.getElementById('strengthLabel');

    // Update per-rule indicators
    setRule('r-len',   val.length >= 8);
    setRule('r-upper', /[A-Z]/.test(val));
    setRule('r-lower', /[a-z]/.test(val));
    setRule('r-num',   /[0-9]/.test(val));
    setRule('r-sym',   /[^A-Za-z0-9]/.test(val));

    // Hapus semua kelas strength
    field.classList.remove('s-weak','s-medium','s-strong','s-vstrong');

    if (!val) { label.textContent = ''; return; }

    let score = 0;
    if (val.length >= 8)  score++;
    if (val.length >= 12) score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    if (score <= 1) {
        field.classList.add('s-weak');
        label.textContent = '🔴 Lemah — terlalu mudah ditebak';
    } else if (score === 2) {
        field.classList.add('s-medium');
        label.textContent = '🟡 Sedang — bisa lebih kuat';
    } else if (score === 3 || score === 4) {
        field.classList.add('s-strong');
        label.textContent = '🟢 Kuat — bagus!';
    } else {
        field.classList.add('s-vstrong');
        label.textContent = '✅ Sangat Kuat — sempurna!';
    }
}

/* ── PAGE TRANSITION ── */
document.getElementById('toLogin').addEventListener('click', function(e) {
    e.preventDefault();
    const href = this.href;
    document.getElementById('page').classList.add('page-leave-left');
    setTimeout(() => location.href = href, 400);
});
</script>
</body>
</html>