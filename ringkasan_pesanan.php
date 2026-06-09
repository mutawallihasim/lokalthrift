<?php
// Data pesanan (bisa diganti dengan data dari database)
$pesanan = [
    [
        'nama'   => 'Crewneck Michigan State',
        'varian' => 'Hijau, M',
        'harga'  => 85000,
        'qty'    => 1,
        'gambar' => 'https://placehold.co/72x72/1a4731/ffffff?text=CR',
    ],
    [
        'nama'   => 'Kemeja Flanel Oversize',
        'varian' => 'Merah, L',
        'harga'  => 75000,
        'qty'    => 1,
        'gambar' => 'https://placehold.co/72x72/7b2d2d/ffffff?text=KF',
    ],
    [
        'nama'   => 'Totebag Canvas Thrift',
        'varian' => 'Putih',
        'harga'  => 35000,
        'qty'    => 1,
        'gambar' => 'https://placehold.co/72x72/e8dcc8/555555?text=TB',
    ],
];

$alamat = [
    'label'  => 'Rumah',
    'detail' => 'Jl. Mower No.12, Kec. Coblong, Kota Bandung, Jawa Barat 40132',
];

$pengiriman = [
    'nama'  => 'JNE Reguler (2–3 hari)',
    'biaya' => 15000,
];

// Hitung subtotal
$subtotal = array_sum(array_map(fn($item) => $item['harga'] * $item['qty'], $pesanan));
$total    = $subtotal + $pengiriman['biaya'];

function formatRupiah(int $nominal): string {
    return 'Rp ' . number_format($nominal, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pesanan</title>
    <style>
        /* ── Reset & Base ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #e8f0fe;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            color: #1a1a2e;
        }

        /* ── Card Wrapper ── */
        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(30, 64, 175, 0.10);
            width: 100%;
            max-width: 860px;
            padding: 28px 28px 24px;
        }

        /* ── Judul ── */
        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 18px;
            background: #2563eb;
            border-radius: 2px;
        }

        /* ── Layout Dua Kolom ── */
        .layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* ── Kolom Kiri: Daftar Produk ── */
        .produk-list {
            background: #f8faff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .produk-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #e2eaf8;
        }

        .produk-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .produk-item:first-child {
            padding-top: 0;
        }

        .produk-img {
            width: 72px;
            height: 72px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #dbeafe;
            background: #e8f0fe;
        }

        .produk-info {
            flex: 1;
        }

        .produk-nama {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 3px;
        }

        .produk-varian {
            font-size: 0.775rem;
            color: #6b7280;
        }

        .produk-harga {
            text-align: right;
            flex-shrink: 0;
        }

        .produk-harga .harga {
            font-size: 0.875rem;
            font-weight: 700;
            color: #1e3a8a;
            display: block;
        }

        .produk-harga .qty {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        /* ── Kolom Kanan: Info Pengiriman & Total ── */
        .info-kanan {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .info-section {
            padding-bottom: 16px;
            margin-bottom: 16px;
            border-bottom: 1px solid #e2eaf8;
        }

        .info-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .info-tipe {
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 2px;
        }

        .info-detail {
            font-size: 0.8rem;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Baris pengiriman */
        .pengiriman-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: #374151;
        }

        .pengiriman-row .biaya {
            color: #2563eb;
            font-weight: 600;
        }

        /* Ringkasan biaya */
        .biaya-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.82rem;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #dbeafe;
        }

        .total-row .total-label {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e3a8a;
        }

        .total-row .total-nilai {
            font-size: 1rem;
            font-weight: 800;
            color: #1e3a8a;
        }

        /* ── Tombol ── */
        .btn-bayar {
            display: block;
            width: 100%;
            margin-top: 22px;
            padding: 15px 0;
            background: #2563eb;
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.18s ease, transform 0.12s ease, box-shadow 0.18s ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.30);
        }

        .btn-bayar:hover {
            background: #1d4ed8;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.38);
            transform: translateY(-1px);
        }

        .btn-bayar:active {
            transform: translateY(0);
        }

        /* ── Responsive ── */
        @media (max-width: 620px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 20px 16px;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <h1 class="card-title">Ringkasan Pesanan</h1>

    <div class="layout">

        <!-- Kolom Kiri: Produk -->
        <div class="produk-list">
            <?php foreach ($pesanan as $item): ?>
                <div class="produk-item">
                    <img
                        src="<?= htmlspecialchars($item['gambar']) ?>"
                        alt="<?= htmlspecialchars($item['nama']) ?>"
                        class="produk-img"
                    >
                    <div class="produk-info">
                        <div class="produk-nama"><?= htmlspecialchars($item['nama']) ?></div>
                        <div class="produk-varian"><?= htmlspecialchars($item['varian']) ?></div>
                    </div>
                    <div class="produk-harga">
                        <span class="harga"><?= formatRupiah($item['harga'] * $item['qty']) ?></span>
                        <span class="qty">x<?= $item['qty'] ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Kolom Kanan: Alamat, Pengiriman, Total -->
        <div class="info-kanan">

            <!-- Alamat Pengiriman -->
            <div class="info-section">
                <div class="info-label">Alamat Pengiriman</div>
                <div class="info-tipe"><?= htmlspecialchars($alamat['label']) ?></div>
                <div class="info-detail"><?= htmlspecialchars($alamat['detail']) ?></div>
            </div>

            <!-- Metode Pengiriman -->
            <div class="info-section">
                <div class="info-label">Metode Pengiriman</div>
                <div class="pengiriman-row">
                    <span><?= htmlspecialchars($pengiriman['nama']) ?></span>
                    <span class="biaya"><?= formatRupiah($pengiriman['biaya']) ?></span>
                </div>
            </div>

            <!-- Subtotal & Total -->
            <div class="info-section">
                <div class="biaya-row">
                    <span>Subtotal (<?= count($pesanan) ?> barang)</span>
                    <span><?= formatRupiah($subtotal) ?></span>
                </div>
                <div class="biaya-row">
                    <span>Ongkos Kirim</span>
                    <span><?= formatRupiah($pengiriman['biaya']) ?></span>
                </div>
                <div class="total-row">
                    <span class="total-label">Total Pembayaran</span>
                    <span class="total-nilai"><?= formatRupiah($total) ?></span>
                </div>
            </div>

        </div>
    </div>

    <!-- Tombol -->
    <a href="#" class="btn-bayar">Lanjut ke Pembayaran</a>
</div>

</body>
</html>