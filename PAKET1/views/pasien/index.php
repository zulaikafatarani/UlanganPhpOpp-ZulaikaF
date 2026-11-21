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
    <title>Data Pasien - KlinikZulaika</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">

    <h1>KlinikZulaika</h1>
    <p class="subtitle">Aplikasi Pengelolaan Data Pasien</p>

    <?php if (isset($_SESSION['pesan'])): ?>
        <div class="alert <?= e($_SESSION['jenis']) ?>">
            <?= e($_SESSION['pesan']) ?>
        </div>

        <?php unset($_SESSION['pesan'], $_SESSION['jenis']); ?>
    <?php endif; ?>

    <a href="index.php?action=create" class="btn tambah">
        + Tambah Pasien
    </a>

    <h2>Daftar Pasien</h2>

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

            <?php if ($dataPasien->num_rows > 0): ?>

                <?php $no = 1; ?>

                <?php while ($row = $dataPasien->fetch_assoc()): ?>

                    <tr>
                        <td><?= $no++ ?></td>

                        <td>
                            <img
                                src="assets/images/pasien/<?= rawurlencode(basename($row['foto'])) ?>"
                                alt="Foto <?= e($row['namapasien']) ?>"
                                class="foto-pasien"
                            >
                        </td>

                        <td><?= e($row['namapasien']) ?></td>
                        <td><?= e($row['username']) ?></td>
                        <td><?= e($row['usia']) ?></td>
                        <td><?= e($row['jeniskelamin']) ?></td>
                        <td><?= e($row['nohp']) ?></td>

                        <td>
                            <a href="index.php?action=show&id=<?= e($row['idpasien']) ?>"
                               class="btn detail">
                                Detail
                            </a>

                            <a href="index.php?action=edit&id=<?= e($row['idpasien']) ?>"
                               class="btn edit">
                                Edit
                            </a>

                            <form action="index.php?action=delete&id=<?= e($row['idpasien']) ?>"
                                  method="POST"
                                  class="form-hapus"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                <button type="submit" class="btn hapus">
                                    Hapus
                                </button>

                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>

            <?php else: ?>

                <tr>
                    <td colspan="8" class="kosong">
                        Belum ada data pasien.
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>
