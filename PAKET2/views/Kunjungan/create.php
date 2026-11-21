views/Kunjungan/create.php


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kunjungan - KlinikAhmadi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container form-container kunjungan-form">

    <h1>Tambah Data Kunjungan</h1>
    <p>Manajemen Riwayat Kunjungan KlinikAhmadi</p>

    <div class="navigation">
        <a href="index.php?module=pasien">
            Data Pasien
        </a>

        <a href="index.php?module=kunjungan" class="active">
            Data Kunjungan
        </a>
    </div>

    <form action="index.php?module=kunjungan&action=store"
          method="POST">

        <label>Pasien</label>
        <select name="idpasien" required>
            <option value="">-- Pilih Pasien --</option>

            <?php while ($row = $dataPasien->fetch_assoc()) : ?>
                <option value="<?= $row['idpasien']; ?>">
                    <?= htmlspecialchars($row['namapasien']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Tanggal Kunjungan</label>
        <input
            type="date"
            name="tanggalkunjungan"
            required
        >

        <label>Keluhan</label>
        <textarea name="keluhan"></textarea>

        <label>Diagnosis</label>
        <textarea name="diagnosis"></textarea>

        <label>Total Kunjungan</label>
        <input
            type="number"
            name="totalkunjungan"
            min="0"
            value="0"
            required
        >

        <label>Jumlah Bayar</label>
        <input
            type="number"
            name="jumlahbayar"
            min="0"
            value="0"
            required
        >

        <label>Kembalian</label>
        <input
            type="number"
            name="kembalian"
            min="0"
            value="0"
            required
        >

        <label>Status Pembayaran</label>
        <select name="statuspembayaran" required>
            <option value="Belum Bayar">Belum Bayar</option>
            <option value="Lunas">Lunas</option>
        </select>

        <label>Status Kunjungan</label>
        <select name="statuskunjungan" required>
            <option value="Proses">Proses</option>
            <option value="Selesai">Selesai</option>
        </select>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="index.php?module=kunjungan"
               class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>

</body>
</html>
