<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pasien - KlinikAhmadi</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<body>

<div class="container pasien-container">

    <h1>Data Pasien</h1>
    <p>Manajemen Data Pasien KlinikAhmadi</p>

    <div class="navigation">
        <a href="index.php?module=pasien" class="active">
            Data Pasien
        </a>

        <a href="index.php?module=kunjungan">
            Data Kunjungan
        </a>
    </div>

    <div class="toolbar">
        <a href="index.php?module=pasien&action=create"
           class="btn btn-primary">
            + Tambah Pasien
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Pasien</th>
                <th>Username</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>

            <?php while ($row = $dataPasien->fetch_assoc()) : ?>
            <tr>
                <td><?= $no++; ?></td>

                <td>
                    <img
                        src="assets/images/pasien/<?= htmlspecialchars($row['foto']); ?>"
                        class="foto-tabel"
                        alt="Foto pasien"
                    >
                </td>

                <td><?= htmlspecialchars($row['namapasien']); ?></td>

                <td><?= htmlspecialchars($row['username']); ?></td>

                <td><?= htmlspecialchars($row['usia']); ?></td>

                <td><?= htmlspecialchars($row['jeniskelamin']); ?></td>

                <td><?= htmlspecialchars($row['nohp']); ?></td>

                <td class="aksi">
                    <a href="index.php?module=pasien&action=show&id=<?= $row['idpasien']; ?>"
                       class="btn btn-info">
                        <i class="fa-solid fa-eye"></i>
                    </a>

                    <a href="index.php?module=pasien&action=edit&id=<?= $row['idpasien']; ?>"
                       class="btn btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <a href="index.php?module=pasien&action=delete&id=<?= $row['idpasien']; ?>"
                       class="btn btn-danger"
                       onclick="return confirm('Yakin ingin menghapus pasien ini?')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

</body>
</html>


