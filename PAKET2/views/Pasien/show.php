<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pasien - KlinikAhmadi</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container form-container">

    <h1>Detail Pasien</h1>

    <div class="detail-foto">
        <img
            src="assets/images/pasien/<?= htmlspecialchars($pasien['foto']); ?>"
            class="foto-detail"
            alt="Foto pasien"
        >
    </div>

    <table class="detail-table">
        <tr>
            <th>ID Pasien</th>
            <td><?= htmlspecialchars($pasien['idpasien']); ?></td>
        </tr>

        <tr>
            <th>Nama Pasien</th>
            <td><?= htmlspecialchars($pasien['namapasien']); ?></td>
        </tr>

        <tr>
            <th>Username</th>
            <td><?= htmlspecialchars($pasien['username']); ?></td>
        </tr>

        <tr>
            <th>Usia</th>
            <td><?= htmlspecialchars($pasien['usia']); ?> tahun</td>
        </tr>

        <tr>
            <th>Alergi Obat</th>
            <td><?= htmlspecialchars($pasien['alergi']); ?></td>
        </tr>

        <tr>
            <th>Jenis Kelamin</th>
            <td><?= htmlspecialchars($pasien['jeniskelamin']); ?></td>
        </tr>

        <tr>
            <th>Alamat</th>
            <td><?= htmlspecialchars($pasien['alamat']); ?></td>
        </tr>

        <tr>
            <th>Nomor HP</th>
            <td><?= htmlspecialchars($pasien['nohp']); ?></td>
        </tr>
    </table>

    <div class="form-actions">
        <a href="index.php?module=pasien&action=edit&id=<?= $pasien['idpasien']; ?>"
           class="btn btn-warning">
            Edit Pasien
        </a>

        <a href="index.php?module=pasien"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>

</body>
</html>
