<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kunjungan - KlinikAhmadi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container form-container kunjungan-form">

    <h1>Edit Data Kunjungan</h1>
    <p>Manajemen Riwayat Kunjungan KlinikAhmadi</p>

    <div class="navigation">
        <a href="index.php?module=pasien">
            Data Pasien
        </a>

        <a href="index.php?module=kunjungan" class="active">
            Data Kunjungan
        </a>
    </div>

    <form action="index.php?module=kunjungan&action=update&id=<?= $data['idkunjungan']; ?>"
          method="POST">

        <label>Pasien</label>
        <select name="idpasien" required>
            <option value="">-- Pilih Pasien --</option>

            <?php while ($row = $dataPasien->fetch_assoc()) : ?>
                <option
                    value="<?= $row['idpasien']; ?>"
                    <?= ($row['idpasien'] == $data['idpasien']) ? 'selected' : ''; ?>
                >
                    <?= htmlspecialchars($row['namapasien']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Tanggal Kunjungan</label>
        <input
            type="date"
            name="tanggalkunjungan"
            value="<?= htmlspecialchars($data['tanggalkunjungan']); ?>"
            required
        >

        <label>Keluhan</label>
        <textarea name="keluhan"><?= htmlspecialchars($data['keluhan'] ?? ''); ?></textarea>

        <label>Diagnosis</label>
        <textarea name="diagnosis"><?= htmlspecialchars($data['diagnosis'] ?? ''); ?></textarea>

        <label>Total Kunjungan</label>
        <input
            type="number"
            name="totalkunjungan"
            min="0"
            value="<?= htmlspecialchars($data['totalkunjungan']); ?>"
            required
        >

        <label>Jumlah Bayar</label>
        <input
            type="number"
            name="jumlahbayar"
            min="0"
            value="<?= htmlspecialchars($data['jumlahbayar']); ?>"
            required
        >

        <label>Kembalian</label>
        <input
            type="number"
            name="kembalian"
            min="0"
            value="<?= htmlspecialchars($data['kembalian']); ?>"
            required
        >

        <label>Status Pembayaran</label>
        <select name="statuspembayaran" required>
            <option
                value="Belum Bayar"
                <?= ($data['statuspembayaran'] == 'Belum Bayar') ? 'selected' : ''; ?>
            >
                Belum Bayar
            </option>

            <option
                value="Lunas"
                <?= ($data['statuspembayaran'] == 'Lunas') ? 'selected' : ''; ?>
            >
                Lunas
            </option>
        </select>

        <label>Status Kunjungan</label>
        <select name="statuskunjungan" required>
            <option
                value="Proses"
                <?= ($data['statuskunjungan'] == 'Proses') ? 'selected' : ''; ?>
            >
                Proses
            </option>

            <option
                value="Selesai"
                <?= ($data['statuskunjungan'] == 'Selesai') ? 'selected' : ''; ?>
            >
                Selesai
            </option>
        </select>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                Update
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
