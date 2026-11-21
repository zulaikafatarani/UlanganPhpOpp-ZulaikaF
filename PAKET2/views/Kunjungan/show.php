<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kunjungan - KlinikAhmadi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container kunjungan-detail-container">

    <h1>Detail Kunjungan</h1>
    <p>Informasi Lengkap Riwayat Kunjungan KlinikAhmadi</p>

    <div class="navigation">
        <a href="index.php?module=pasien">
            Data Pasien
        </a>

        <a href="index.php?module=kunjungan" class="active">
            Data Kunjungan
        </a>
    </div>

    <div class="detail-wrapper">

        <div class="detail-section">

            <h2>Informasi Kunjungan</h2>

            <table class="detail-table">
                <tr>
                    <th>ID Kunjungan</th>
                    <td><?= htmlspecialchars($kunjungan['idkunjungan']); ?></td>
                </tr>

                <tr>
                    <th>Nama Pasien</th>
                    <td><?= htmlspecialchars($kunjungan['namapasien']); ?></td>
                </tr>

                <tr>
                    <th>Tanggal Kunjungan</th>
                    <td><?= htmlspecialchars($kunjungan['tanggalkunjungan']); ?></td>
                </tr>

                <tr>
                    <th>Keluhan</th>
                    <td><?= nl2br(htmlspecialchars($kunjungan['keluhan'] ?? '')); ?></td>
                </tr>

                <tr>
                    <th>Diagnosis</th>
                    <td><?= nl2br(htmlspecialchars($kunjungan['diagnosis'] ?? '')); ?></td>
                </tr>
            </table>

        </div>

        <div class="detail-section">

            <h2>Informasi Pembayaran</h2>

            <table class="detail-table">
                <tr>
                    <th>Total Kunjungan</th>
                    <td>
                        Rp <?= number_format($kunjungan['totalkunjungan'], 0, ',', '.'); ?>
                    </td>
                </tr>

                <tr>
                    <th>Jumlah Bayar</th>
                    <td>
                        Rp <?= number_format($kunjungan['jumlahbayar'], 0, ',', '.'); ?>
                    </td>
                </tr>

                <tr>
                    <th>Kembalian</th>
                    <td>
                        Rp <?= number_format($kunjungan['kembalian'], 0, ',', '.'); ?>
                    </td>
                </tr>

                <tr>
                    <th>Status Pembayaran</th>
                    <td>
                        <span class="status">
                            <?= htmlspecialchars($kunjungan['statuspembayaran']); ?>
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Status Kunjungan</th>
                    <td>
                        <span class="status">
                            <?= htmlspecialchars($kunjungan['statuskunjungan']); ?>
                        </span>
                    </td>
                </tr>
            </table>

        </div>

    </div>

    <div class="form-actions">
        <a href="index.php?module=kunjungan&action=edit&id=<?= $kunjungan['idkunjungan']; ?>"
           class="btn btn-warning">
            Edit Kunjungan
        </a>

        <a href="index.php?module=kunjungan"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>

</body>
</html>

