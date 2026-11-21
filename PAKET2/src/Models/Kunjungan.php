<?php

namespace App\Models;

class Kunjungan
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    // Menampilkan seluruh data kunjungan beserta nama pasien
    public function tampil()
    {
        $query = "SELECT
                    kunjungan.*,
                    pasien.namapasien
                  FROM kunjungan
                  INNER JOIN pasien
                    ON kunjungan.idpasien = pasien.idpasien
                  ORDER BY kunjungan.idkunjungan DESC";

        return $this->koneksi->query($query);
    }

    // Mengambil satu data kunjungan berdasarkan ID
    public function ambil($id)
    {
        $query = "SELECT
                    kunjungan.*,
                    pasien.namapasien
                  FROM kunjungan
                  INNER JOIN pasien
                    ON kunjungan.idpasien = pasien.idpasien
                  WHERE kunjungan.idkunjungan = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $hasil = $stmt->get_result();

        return $hasil->fetch_assoc();
    }

    // Mengambil seluruh data pasien untuk pilihan form
    public function tampilPasien()
    {
        $query = "SELECT idpasien, namapasien
                  FROM pasien
                  ORDER BY namapasien ASC";

        return $this->koneksi->query($query);
    }

    // Menambahkan data kunjungan
    public function tambah($data)
    {
        $query = "INSERT INTO kunjungan
                  (
                    idpasien,
                    tanggalkunjungan,
                    keluhan,
                    diagnosis,
                    totalkunjungan,
                    jumlahbayar,
                    kembalian,
                    statuspembayaran,
                    statuskunjungan
                  )
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->koneksi->prepare($query);

        $stmt->bind_param(
            "isssiiiss",
            $data['idpasien'],
            $data['tanggalkunjungan'],
            $data['keluhan'],
            $data['diagnosis'],
            $data['totalkunjungan'],
            $data['jumlahbayar'],
            $data['kembalian'],
            $data['statuspembayaran'],
            $data['statuskunjungan']
        );

        return $stmt->execute();
    }

    // Mengubah data kunjungan
    public function ubah($id, $data)
    {
        $query = "UPDATE kunjungan SET
                  idpasien = ?,
                  tanggalkunjungan = ?,
                  keluhan = ?,
                  diagnosis = ?,
                  totalkunjungan = ?,
                  jumlahbayar = ?,
                  kembalian = ?,
                  statuspembayaran = ?,
                  statuskunjungan = ?
                  WHERE idkunjungan = ?";

        $stmt = $this->koneksi->prepare($query);

        $stmt->bind_param(
            "isssiiissi",
            $data['idpasien'],
            $data['tanggalkunjungan'],
            $data['keluhan'],
            $data['diagnosis'],
            $data['totalkunjungan'],
            $data['jumlahbayar'],
            $data['kembalian'],
            $data['statuspembayaran'],
            $data['statuskunjungan'],
            $id
        );

        return $stmt->execute();
    }

    // Menghapus data kunjungan
    public function hapus($id)
    {
        $query = "DELETE FROM kunjungan
                  WHERE idkunjungan = ?";

        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}

