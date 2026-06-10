<?php
$error = $success = '';
$step  = isset($_POST['step']) ? (int)$_POST['step'] : 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ── STEP 1 : kirim email ── */
    if ($step === 1) {
        $email = trim($_POST['email'] ?? '');
        if (!$email)
            $error = 'Email harus diisi.';
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $error = 'Format email tidak valid.';
        else {
            $success = 'Kode OTP telah dikirim ke ' . htmlspecialchars($email) . '. Cek inbox atau folder spam kamu.';
            $step    = 2;
        }
    }

    /* ── STEP 2 : verifikasi OTP ── */
    elseif ($step === 2) {
        $otp = trim($_POST['otp'] ?? '');
        if (!$otp)
            $error = 'Kode OTP harus diisi.';
        elseif (strlen($otp) !== 6 || !ctype_digit($otp))
            $error = 'Kode OTP harus 6 digit angka.';
        else
            $step = 3;
    }

    /* ── STEP 3 : reset password ── */
    elseif ($step === 3) {
        $password = $_POST['password']         ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';
        if (!$password || !$confirm)
            $error = 'Semua field harus diisi.';
        elseif (strlen($password) < 8)
            $error = 'Password minimal 8 karakter.';
        elseif ($password !== $confirm)
            $error = 'Konfirmasi password tidak cocok.';
        else {
            $success = 'Password berhasil diubah! Silakan login dengan password baru.';
            $step    = 4;
        }
    }
}

$email_val = htmlspecialchars($_POST['email'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokalThrift – Lupa Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* STEP INDICATOR */
        .steps {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 22px;
        }
        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }
        .step-circle {
            width: 32px; height: 32px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: var(--white);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
            color: var(--text-light);
            transition: all .3s;
            position: relative;
            z-index: 1;
        }
        .step-circle.active {
            border-color: var(--primary);
            background: var(--primary);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(37,99,235,0.12);
        }
        .step-circle.done {
            border-color: var(--success);
            background: var(--success);
            color: #fff;
        }
        .step-circle.done svg { display: block; }
        .step-circle svg { display: none; width: 14px; height: 14px; stroke: #fff; stroke-width: 2.5; fill: none; }
        .step-label {
            font-size: 10.5px; font-weight: 600;
            color: var(--text-light);
            white-space: nowrap;
        }
        .step-label.active { color: var(--primary); }
        .step-label.done   { color: var(--success); }

        .step-line {
            flex: 1;
            height: 2px;
            background: var(--border);
            margin: 0 6px;
            margin-bottom: 22px;
            transition: background .3s;
            min-width: 28px;
        }
        .step-line.done { background: var(--success); }

        /* BACK LINK */
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 600;
            color: var(--text-mid); text-decoration: none;
            margin-bottom: 18px;
            transition: color .2s;
        }
        .back-link:hover { color: var(--primary); }
        .back-link svg { width: 16px; height: 16px; }

        /* OTP INPUT */
        .otp-wrap {
            display: flex; gap: 8px; justify-content: center;
            margin-bottom: 6px;
        }
        .otp-wrap input {
            width: 44px; height: 52px;
            text-align: center;
            font-size: 20px; font-weight: 700;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            color: var(--text-dark);
            background: var(--white);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            caret-color: var(--primary);
        }
        .otp-wrap input:focus {
            border-color: var(--primary);
            background: #F0F6FF;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        }
        .otp-wrap input.filled {
            border-color: var(--primary);
            background: #EEF4FF;
        }

        .resend-row {
            text-align: center;
            font-size: 12.5px;
            color: var(--text-light);
            margin-top: 10px;
        }
        .resend-row button {
            background: none; border: none; cursor: pointer;
            color: var(--primary); font-weight: 700;
            font-family: inherit; font-size: 12.5px;
            padding: 0;
            transition: opacity .2s;
        }
        .resend-row button:disabled { color: var(--text-light); cursor: default; }
        #countdown { font-weight: 700; color: var(--primary); }

        /* SUCCESS STATE */
        .success-state {
            display: flex; flex-direction: column; align-items: center;
            gap: 12px; padding: 12px 0 8px;
            text-align: center;
        }
        .success-icon {
            width: 64px; height: 64px;
            border-radius: 50%;
            background: #ECFDF5;
            border: 2px solid #A7F3D0;
            display: flex; align-items: center; justify-content: center;
            animation: popIn .4s cubic-bezier(.22,1,.36,1) both;
        }
        .success-icon svg { width: 28px; height: 28px; stroke: var(--success); stroke-width: 2.5; fill: none; }
        @keyframes popIn { from { transform: scale(.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .success-state h2 { font-size: 18px; font-weight: 700; color: var(--text-dark); }
        .success-state p  { font-size: 13.5px; color: var(--text-mid); line-height: 1.6; }

        /* PASSWORD STRENGTH (sama seperti register) */
        .strength-bar { display: flex; gap: 4px; margin-top: 8px; }
        .strength-bar span { flex: 1; height: 4px; border-radius: 99px; background: var(--border); transition: background .3s; }
        .strength-label { font-size: 11.5px; font-weight: 600; margin-top: 5px; min-height: 16px; transition: color .3s; }
        .s-weak   .strength-bar span:nth-child(1)                        { background: #EF4444; }
        .s-medium .strength-bar span:nth-child(1),
        .s-medium .strength-bar span:nth-child(2)                        { background: #F59E0B; }
        .s-strong .strength-bar span:nth-child(1),
        .s-strong .strength-bar span:nth-child(2),
        .s-strong .strength-bar span:nth-child(3)                        { background: #10B981; }
        .s-vstrong .strength-bar span                                     { background: #059669; }
        .s-weak   .strength-label { color: #EF4444; }
        .s-medium .strength-label { color: #F59E0B; }
        .s-strong .strength-label { color: #10B981; }
        .s-vstrong .strength-label { color: #059669; }
    </style>
</head>
<body>
<div class="page" id="page">
    <div class="card card-slide-up">

        <!-- LOGO -->
        <div class="logo-area" style="gap:6px; margin-bottom:18px;">
            <img src="Logo.svg" alt="LokalThrift" style="width:260px; height:88px; object-fit:contain;">
        </div>

        <!-- STEP INDICATOR (sembunyikan di step 4) -->
        <?php if ($step < 4): ?>
        <div class="steps">
            <div class="step-item">
                <div class="step-circle <?= $step > 1 ? 'done' : ($step === 1 ? 'active' : '') ?>">
                    <svg viewBox="0 0 14 14"><polyline points="1,7 5,11 13,2"/></svg>
                    <?= $step <= 1 ? '1' : '' ?>
                </div>
                <span class="step-label <?= $step > 1 ? 'done' : ($step === 1 ? 'active' : '') ?>">Email</span>
            </div>
            <div class="step-line <?= $step > 1 ? 'done' : '' ?>"></div>
            <div class="step-item">
                <div class="step-circle <?= $step > 2 ? 'done' : ($step === 2 ? 'active' : '') ?>">
                    <svg viewBox="0 0 14 14"><polyline points="1,7 5,11 13,2"/></svg>
                    <?= $step <= 2 ? '2' : '' ?>
                </div>
                <span class="step-label <?= $step > 2 ? 'done' : ($step === 2 ? 'active' : '') ?>">Verifikasi</span>
            </div>
            <div class="step-line <?= $step > 2 ? 'done' : '' ?>"></div>
            <div class="step-item">
                <div class="step-circle <?= $step === 3 ? 'active' : '' ?>">
                    <svg viewBox="0 0 14 14"><polyline points="1,7 5,11 13,2"/></svg>
                    3
                </div>
                <span class="step-label <?= $step === 3 ? 'active' : '' ?>">Password Baru</span>
            </div>
        </div>
        <?php endif; ?>

        <!-- ALERTS -->
        <?php if ($error):   ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if ($success && $step !== 4): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

        <?php if ($step === 1): ?>
        <!-- ══════════ STEP 1: INPUT EMAIL ══════════ -->
        <h1 class="card-title">Lupa Password?</h1>
        <p class="card-sub">Masukkan email akunmu dan kami akan kirimkan kode verifikasi.</p>

        <form method="POST">
            <input type="hidden" name="step" value="1">
            <div class="field">
                <label>Email</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="3"/><path d="m2 7 10 7 10-7"/></svg>
                    <input type="email" name="email" placeholder="contoh@gmail.com" value="<?= $email_val ?>" required>
                </div>
            </div>
            <button type="submit" class="btn-primary">Kirim Kode OTP</button>
        </form>

        <div class="switch-link">
            <a href="login.php" id="toLogin">← Kembali ke Login</a>
        </div>

        <?php elseif ($step === 2): ?>
        <!-- ══════════ STEP 2: INPUT OTP ══════════ -->
        <h1 class="card-title">Masukkan Kode OTP</h1>
        <p class="card-sub">Kode 6 digit telah dikirim ke<br><strong style="color:var(--text-dark)"><?= $email_val ?></strong></p>

        <form method="POST" id="otpForm">
            <input type="hidden" name="step" value="2">
            <input type="hidden" name="email" value="<?= $email_val ?>">
            <input type="hidden" name="otp" id="otpHidden">

            <div class="otp-wrap" id="otpWrap">
                <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" autocomplete="one-time-code">
                <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]">
            </div>

            <div class="resend-row">
                Tidak dapat kode? <button type="button" id="resendBtn" disabled onclick="resendOtp()">Kirim ulang</button>
                <span id="countdown">(60)</span>
            </div>

            <button type="submit" class="btn-primary" style="margin-top:18px;">Verifikasi</button>
        </form>

        <div class="switch-link">
            <a href="forgot_password.php" id="toStep1">← Ganti email</a>
        </div>

        <?php elseif ($step === 3): ?>
        <!-- ══════════ STEP 3: RESET PASSWORD ══════════ -->
        <h1 class="card-title">Buat Password Baru</h1>
        <p class="card-sub">Pastikan password baru lebih kuat dari sebelumnya.</p>

        <form method="POST" id="resetForm">
            <input type="hidden" name="step" value="3">
            <input type="hidden" name="email" value="<?= $email_val ?>">

            <div class="field" id="pwField">
                <label>Password Baru</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <input type="password" id="pw1" name="password" placeholder="minimal 8 karakter" oninput="checkStrength(this.value)" required>
                    <button type="button" class="toggle-pw" onclick="togglePw('pw1','eye1')">
                        <svg id="eye1" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                <div class="strength-bar"><span></span><span></span><span></span><span></span></div>
                <div class="strength-label" id="strengthLabel"></div>
            </div>

            <div class="field">
                <label>Konfirmasi Password Baru</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <input type="password" id="pw2" name="confirm_password" placeholder="ulangi password baru" required>
                    <button type="button" class="toggle-pw" onclick="togglePw('pw2','eye2')">
                        <svg id="eye2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-primary">Simpan Password Baru</button>
        </form>

        <?php elseif ($step === 4): ?>
        <!-- ══════════ STEP 4: SUKSES ══════════ -->
        <div class="success-state">
            <div class="success-icon">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <h2>Password Berhasil Diubah!</h2>
            <p>Kamu sekarang bisa masuk menggunakan<br>password barumu.</p>
            <a href="login.php" class="btn-primary" style="display:flex;align-items:center;justify-content:center;text-decoration:none;margin-top:8px;" id="toLogin">
                Masuk Sekarang
            </a>
        </div>
        <?php endif; ?>

    </div>

    <div class="bottom-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Aman <span class="dot"></span> Cepat <span class="dot"></span> Terpercaya
    </div>
</div>

<script>
/* ── PAGE TRANSITION ke login ── */
function goLogin(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.href;
        document.getElementById('page').classList.add('page-leave-left');
        setTimeout(() => location.href = href, 400);
    });
}
goLogin('toLogin');
goLogin('toStep1');

/* ── TOGGLE PASSWORD ── */
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
    field.classList.remove('s-weak','s-medium','s-strong','s-vstrong');
    if (!val) { label.textContent = ''; return; }
    let score = 0;
    if (val.length >= 8)  score++;
    if (val.length >= 12) score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    if (score <= 1) { field.classList.add('s-weak');   label.textContent = '🔴 Lemah — terlalu mudah ditebak'; }
    else if (score === 2) { field.classList.add('s-medium'); label.textContent = '🟡 Sedang — bisa lebih kuat'; }
    else if (score <= 4)  { field.classList.add('s-strong'); label.textContent = '🟢 Kuat — bagus!'; }
    else                  { field.classList.add('s-vstrong'); label.textContent = '✅ Sangat Kuat — sempurna!'; }
}

/* ── OTP INPUTS ── */
(function() {
    const wrap = document.getElementById('otpWrap');
    if (!wrap) return;
    const inputs = wrap.querySelectorAll('input');

    inputs.forEach((inp, idx) => {
        inp.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g,'').slice(-1);
            this.classList.toggle('filled', this.value !== '');
            if (this.value && idx < inputs.length - 1) inputs[idx + 1].focus();
            syncHidden();
        });
        inp.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && idx > 0) {
                inputs[idx - 1].value = '';
                inputs[idx - 1].classList.remove('filled');
                inputs[idx - 1].focus();
                syncHidden();
            }
        });
        inp.addEventListener('paste', function(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g,'').slice(0,6);
            text.split('').forEach((ch, i) => {
                if (inputs[i]) { inputs[i].value = ch; inputs[i].classList.add('filled'); }
            });
            if (inputs[Math.min(text.length, inputs.length-1)]) inputs[Math.min(text.length, inputs.length-1)].focus();
            syncHidden();
        });
    });

    function syncHidden() {
        document.getElementById('otpHidden').value = Array.from(inputs).map(i => i.value).join('');
    }

    /* countdown resend */
    let secs = 60;
    const btn = document.getElementById('resendBtn');
    const cd  = document.getElementById('countdown');
    const timer = setInterval(() => {
        secs--;
        cd.textContent = secs > 0 ? '(' + secs + ')' : '';
        if (secs <= 0) { clearInterval(timer); btn.disabled = false; }
    }, 1000);
})();

function resendOtp() {
    const btn = document.getElementById('resendBtn');
    const cd  = document.getElementById('countdown');
    btn.disabled = true;
    let secs = 60;
    cd.textContent = '(60)';
    const timer = setInterval(() => {
        secs--;
        cd.textContent = secs > 0 ? '(' + secs + ')' : '';
        if (secs <= 0) { clearInterval(timer); btn.disabled = false; }
    }, 1000);
}
</script>
</body>
</html>
