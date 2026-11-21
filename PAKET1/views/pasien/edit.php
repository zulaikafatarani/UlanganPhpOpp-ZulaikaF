<?php
function e($nilai)
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pasien</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container form-container">

    <h1>Edit Data Pasien</h1>

    <form action="index.php?action=update&id=<?= e($data['idpasien']) ?>"
          method="POST"
          enctype="multipart/form-data">

        <label>Nama Pasien</label>
        <input
            type="text"
            name="namapasien"
            maxlength="100"
            required
            value="<?= e($data['namapasien']) ?>"
        >

        <label>Username</label>
        <input
            type="text"
            name="username"
            maxlength="100"
            required
            value="<?= e($data['username']) ?>"
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            maxlength="255"
            placeholder="Kosongkan jika tidak ingin mengubah password"
        >

        <label>Usia</label>
        <input
            type="number"
            name="usia"
            min="1"
            max="150"
            required
            value="<?= e($data['usia']) ?>"
        >

        <label>Alergi</label>
        <input
            type="text"
            name="alergi"
            maxlength="255"
            required
            value="<?= e($data['alergi']) ?>"
        >

        <label>Jenis Kelamin</label>
        <select name="jeniskelamin" required>

            <option value="">-- Pilih Jenis Kelamin --</option>

            <option value="Laki-laki"
                <?= $data['jeniskelamin'] === 'Laki-laki' ? 'selected' : '' ?>>
                Laki-laki
            </option>

            <option value="Perempuan"
                <?= $data['jeniskelamin'] === 'Perempuan' ? 'selected' : '' ?>>
                Perempuan
            </option>

        </select>

        <label>Alamat</label>
        <textarea name="alamat" rows="4" maxlength="255"><?= e($data['alamat']) ?></textarea>

        <label>Nomor HP</label>
        <input
            type="text"
            name="nohp"
            maxlength="15"
            pattern="[0-9]*"
            value="<?= e($data['nohp']) ?>"
        >

        <label>Foto Pasien Saat Ini</label>

        <img
            src="assets/images/pasien/<?= rawurlencode(basename($data['foto'])) ?>"
            alt="Foto <?= e($data['namapasien']) ?>"
            class="foto-preview"
        >

        <label>Ganti Foto Pasien</label>
        <input
            type="file"
            name="foto"
            accept=".jpg,.jpeg,.png,.webp"
        >

        <small>
            Kosongkan jika tidak ingin mengganti foto.
            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
        </small>

        <button type="submit" class="btn edit">
            Update Pasien
        </button>

        <a href="index.php" class="btn kembali">
            Kembali
        </a>

    </form>

</div>

</body>
</html>
