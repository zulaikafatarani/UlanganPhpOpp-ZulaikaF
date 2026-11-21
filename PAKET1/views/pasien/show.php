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
    <title>Detail Pasien</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">

    <h1>Detail Pasien</h1>

    <div class="foto-detail">
        <img
            src="assets/images/pasien/<?= rawurlencode(basename($data['foto'])) ?>"
            alt="Foto <?= e($data['namapasien']) ?>"
            class="foto-besar"
        >
    </div>

    <table class="detail-table">

        <tr>
            <th>ID Pasien</th>
            <td><?= e($data['idpasien']) ?></td>
        </tr>

        <tr>
            <th>Nama Pasien</th>
            <td><?= e($data['namapasien']) ?></td>
        </tr>

        <tr>
            <th>Username</th>
            <td><?= e($data['username']) ?></td>
        </tr>

        <tr>
            <th>Usia</th>
            <td><?= e($data['usia']) ?> tahun</td>
        </tr>

        <tr>
            <th>Alergi</th>
            <td><?= e($data['alergi']) ?></td>
        </tr>

        <tr>
            <th>Jenis Kelamin</th>
            <td><?= e($data['jeniskelamin']) ?></td>
        </tr>

        <tr>
            <th>Alamat</th>
            <td><?= nl2br(e($data['alamat'])) ?></td>
        </tr>

        <tr>
            <th>Nomor HP</th>
            <td><?= e($data['nohp']) ?></td>
        </tr>

        <tr>
            <th>Nama File Foto</th>
            <td><?= e($data['foto']) ?></td>
        </tr>

    </table>

    <a href="index.php" class="btn kembali">
        Kembali
    </a>

</div>

</body>
</html>
