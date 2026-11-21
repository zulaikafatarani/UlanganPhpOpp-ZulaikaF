<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pasien</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container form-container">

    <h1>Tambah Data Pasien</h1>

    <form action="index.php?action=store"
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
            max="150"
            required
        >

        <label>Alergi</label>
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
        <textarea name="alamat" rows="4" maxlength="255"></textarea>

        <label>Nomor HP</label>
        <input
            type="text"
            name="nohp"
            maxlength="15"
            pattern="[0-9]*"
        >

        <label>Foto Pasien</label>
        <input
            type="file"
            name="foto"
            accept=".jpg,.jpeg,.png,.webp"
            required
        >

        <small>Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</small>

        <button type="submit" class="btn tambah">
            Simpan Pasien
        </button>

        <a href="index.php" class="btn kembali">
            Kembali
        </a>

    </form>

</div>

</body>
</html>
