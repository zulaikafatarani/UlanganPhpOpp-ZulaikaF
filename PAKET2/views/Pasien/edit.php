<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pasien - KlinikAhmadi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container form-container">

    <h1>Edit Data Pasien</h1>
    <p>Perbarui Informasi Pasien KlinikAhmadi</p>

    <div class="navigation">
        <a href="index.php?module=pasien" class="active">
            Data Pasien
        </a>

        <a href="index.php?module=kunjungan">
            Data Kunjungan
        </a>
    </div>

    <form action="index.php?module=pasien&action=update&id=<?= $pasien['idpasien']; ?>"
          method="POST"
          enctype="multipart/form-data">

        <label>Nama Pasien</label>
        <input
            type="text"
            name="namapasien"
            maxlength="100"
            value="<?= htmlspecialchars($pasien['namapasien']); ?>"
            required
        >

        <label>Username</label>
        <input
            type="text"
            name="username"
            maxlength="100"
            value="<?= htmlspecialchars($pasien['username']); ?>"
            required
        >

        <label>Password Baru</label>
        <input
            type="password"
            name="password"
            maxlength="255"
            placeholder="Masukkan password baru"
            required
        >

        <label>Usia</label>
        <input
            type="number"
            name="usia"
            min="1"
            value="<?= htmlspecialchars($pasien['usia']); ?>"
            required
        >

        <label>Alergi Obat</label>
        <input
            type="text"
            name="alergi"
            maxlength="255"
            placeholder="Contoh: Mual, Gatal, Bengkak, Sesak Napas"
            value="<?= htmlspecialchars($pasien['alergi']); ?>"
            required
        >

        <label>Jenis Kelamin</label>
        <select name="jeniskelamin" required>
            <option value="">-- Pilih Jenis Kelamin --</option>

            <option value="Laki-laki"
                <?= $pasien['jeniskelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>
                Laki-laki
            </option>

            <option value="Perempuan"
                <?= $pasien['jeniskelamin'] == 'Perempuan' ? 'selected' : ''; ?>>
                Perempuan
            </option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat" maxlength="255"><?= htmlspecialchars($pasien['alamat']); ?></textarea>

        <label>Nomor HP</label>
        <input
            type="text"
            name="nohp"
            maxlength="15"
            value="<?= htmlspecialchars($pasien['nohp']); ?>"
        >

        <label>Foto Pasien Saat Ini</label>

        <div class="foto-preview">
            <img
                src="assets/images/pasien/<?= htmlspecialchars($pasien['foto']); ?>"
                class="foto-detail"
                alt="Foto pasien saat ini"
            >
        </div>

        <label>Ganti Foto Pasien</label>
        <input
            type="file"
            name="foto"
            accept=".jpg,.jpeg,.png,.webp"
        >

        <small>
            Kosongkan jika tidak ingin mengganti foto pasien.
        </small>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                Perbarui
            </button>

            <a href="index.php?module=pasien"
               class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>

</body>
</html>
