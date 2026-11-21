<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pasien - KlinikAhmadi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container form-container">

    <h1>Tambah Data Pasien</h1>
    <p>Perbarui Informasi Pasien KlinikAhmadi</p>

    <div class="navigation">
        <a href="index.php?module=pasien" class="active">
            Data Pasien
        </a>

        <a href="index.php?module=kunjungan">
            Data Kunjungan
        </a>
    </div>

    <form action="index.php?module=pasien&action=store"
          method="POST"
          enctype="multipart/form-data">

        <label>Nama Pasien</label>
        <input
            type="text"
            name="namapasien"
            maxlength="100"
            required
        >

        <label>Username</label>
        <input
            type="text"
            name="username"
            maxlength="100"
            required
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            maxlength="255"
            required
        >

        <label>Usia</label>
        <input
            type="number"
            name="usia"
            min="1"
            required
        >

        <label>Alergi Obat</label>
        <input
            type="text"
            name="alergi"
            maxlength="255"
            placeholder="Contoh: Mual, Gatal, Bengkak, Sesak Napas"
            required
        >

        <label>Jenis Kelamin</label>
        <select name="jeniskelamin" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat" maxlength="255"></textarea>

        <label>Nomor HP</label>
        <input
            type="text"
            name="nohp"
            maxlength="15"
        >

        <label>Foto Pasien</label>
        <input
            type="file"
            name="foto"
            accept=".jpg,.jpeg,.png,.webp"
            required
        >

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                Simpan
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
