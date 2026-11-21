<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kunjungan - KlinikAhmadi</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<div class="container kunjungan-container">

    <h1>Data Kunjungan</h1>
    <p>Manajemen Riwayat Kunjungan KlinikAhmadi</p>

    <div class="navigation">
        <a href="index.php?module=pasien">
            Data Pasien
        </a>

        <a href="index.php?module=kunjungan" class="active">
            Data Kunjungan
        </a>
    </div>

    <div class="toolbar">
        <a href="index.php?module=kunjungan&action=create"
           class="btn btn-primary">
            + Tambah Kunjungan
        </a>
    </div>

    <div class="table-responsive">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal</th>
                    <th>Keluhan</th>
                    <th>Diagnosis</th>
                    <th>Total</th>
                    <th>Status Pembayaran</th>
                    <th>Status Kunjungan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; ?>

                <?php while ($row = $dataKunjungan->fetch_assoc()) : ?>
                <tr>
                    <td><?= $no++; ?></td>

                    <td>
                        <?= htmlspecialchars($row['namapasien']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['tanggalkunjungan']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['keluhan']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['diagnosis']); ?>
                    </td>

                    <td>
                        Rp <?= number_format($row['totalkunjungan'], 0, ',', '.'); ?>
                    </td>

                    <td>
                        <span class="status">
                            <?= htmlspecialchars($row['statuspembayaran']); ?>
                        </span>
                    </td>

                    <td>
                        <span class="status">
                            <?= htmlspecialchars($row['statuskunjungan']); ?>
                        </span>
                    </td>

                    <td class="aksi">

                        <a href="index.php?module=kunjungan&action=show&id=<?= $row['idkunjungan']; ?>"
                        class="btn btn-info"
                        title="Detail"
                        aria-label="Detail">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="index.php?module=kunjungan&action=edit&id=<?= $row['idkunjungan']; ?>"
                        class="btn btn-warning"
                        title="Edit"
                        aria-label="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <a href="index.php?module=kunjungan&action=delete&id=<?= $row['idkunjungan']; ?>"
                        class="btn btn-danger"
                        title="Hapus"
                        aria-label="Hapus"
                        onclick="return confirm('Yakin ingin menghapus kunjungan ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </a>

                    </td>

                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>

</div>

</body>
</html>
