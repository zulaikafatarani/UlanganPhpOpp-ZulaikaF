<?php

namespace App\Controllers;

use App\Models\Kunjungan;

class KunjunganController
{
    private $kunjungan;

    public function __construct($koneksi)
    {
        $this->kunjungan = new Kunjungan($koneksi);
    }

    // Menampilkan seluruh data kunjungan
    public function index()
    {
        $dataKunjungan = $this->kunjungan->tampil();

        require 'views/Kunjungan/index.php';
    }

    // Menampilkan formulir tambah kunjungan
    public function create()
    {
        $dataPasien = $this->kunjungan->tampilPasien();

        require 'views/Kunjungan/create.php';
    }

    // Menyimpan data kunjungan
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?module=kunjungan');
            exit;
        }

        $idpasien = (int) $_POST['idpasien'];
        $tanggal = $_POST['tanggalkunjungan'];

        $keluhan = trim($_POST['keluhan']);
        $diagnosis = trim($_POST['diagnosis']);

        $total = (int) $_POST['totalkunjungan'];
        $jumlahBayar = (int) $_POST['jumlahbayar'];
        $kembalian = (int) $_POST['kembalian'];

        $statusPembayaran = $_POST['statuspembayaran'];
        $statusKunjungan = $_POST['statuskunjungan'];

        // Memastikan pasien tersedia
        $daftarPasien = $this->kunjungan->tampilPasien();
        $pasienValid = false;

        while ($row = $daftarPasien->fetch_assoc()) {
            if ((int) $row['idpasien'] === $idpasien) {
                $pasienValid = true;
                break;
            }
        }

        if (!$pasienValid) {
            die('Pasien yang dipilih tidak valid.');
        }

        // Validasi tanggal
        $tanggalValid = \DateTime::createFromFormat('Y-m-d', $tanggal);

        if (
            !$tanggalValid ||
            $tanggalValid->format('Y-m-d') !== $tanggal
        ) {
            die('Tanggal kunjungan tidak valid.');
        }

        // Validasi angka
        if (
            $total < 0 ||
            $jumlahBayar < 0 ||
            $kembalian < 0
        ) {
            die('Nilai pembayaran tidak boleh negatif.');
        }

        // Validasi status
        $statusPembayaranValid = [
            'Belum Bayar',
            'Lunas'
        ];

        $statusKunjunganValid = [
            'Proses',
            'Selesai'
        ];

        if (
            !in_array($statusPembayaran, $statusPembayaranValid) ||
            !in_array($statusKunjungan, $statusKunjunganValid)
        ) {
            die('Status kunjungan atau pembayaran tidak valid.');
        }

        $data = [
            'idpasien' => $idpasien,
            'tanggalkunjungan' => $tanggal,
            'keluhan' => $keluhan,
            'diagnosis' => $diagnosis,
            'totalkunjungan' => $total,
            'jumlahbayar' => $jumlahBayar,
            'kembalian' => $kembalian,
            'statuspembayaran' => $statusPembayaran,
            'statuskunjungan' => $statusKunjungan
        ];

        $hasil = $this->kunjungan->tambah($data);

        if ($hasil) {
            header('Location: index.php?module=kunjungan');
            exit;
        }

        die('Gagal menyimpan data kunjungan.');
    }

    // Menampilkan formulir edit kunjungan
    public function edit($id)
    {
        $data = $this->kunjungan->ambil($id);

        if (!$data) {
            die('Data kunjungan tidak ditemukan.');
        }

        $dataPasien = $this->kunjungan->tampilPasien();

        require 'views/Kunjungan/edit.php';
    }

    // Memperbarui data kunjungan
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?module=kunjungan');
            exit;
        }

        $kunjunganLama = $this->kunjungan->ambil($id);

        if (!$kunjunganLama) {
            die('Data kunjungan tidak ditemukan.');
        }

        $idpasien = (int) $_POST['idpasien'];
        $tanggal = $_POST['tanggalkunjungan'];

        $total = (int) $_POST['totalkunjungan'];
        $jumlahBayar = (int) $_POST['jumlahbayar'];
        $kembalian = (int) $_POST['kembalian'];

        $statusPembayaran = $_POST['statuspembayaran'];
        $statusKunjungan = $_POST['statuskunjungan'];

        // Memastikan pasien tersedia
        $daftarPasien = $this->kunjungan->tampilPasien();
        $pasienValid = false;

        while ($row = $daftarPasien->fetch_assoc()) {
            if ((int) $row['idpasien'] === $idpasien) {
                $pasienValid = true;
                break;
            }
        }

        if (!$pasienValid) {
            die('Pasien yang dipilih tidak valid.');
        }

        // Validasi tanggal
        $tanggalValid = \DateTime::createFromFormat('Y-m-d', $tanggal);

        if (
            !$tanggalValid ||
            $tanggalValid->format('Y-m-d') !== $tanggal
        ) {
            die('Tanggal kunjungan tidak valid.');
        }

        // Validasi angka
        if (
            $total < 0 ||
            $jumlahBayar < 0 ||
            $kembalian < 0
        ) {
            die('Nilai pembayaran tidak boleh negatif.');
        }

        // Validasi status
        $statusPembayaranValid = [
            'Belum Bayar',
            'Lunas'
        ];

        $statusKunjunganValid = [
            'Proses',
            'Selesai'
        ];

        if (
            !in_array($statusPembayaran, $statusPembayaranValid) ||
            !in_array($statusKunjungan, $statusKunjunganValid)
        ) {
            die('Status kunjungan atau pembayaran tidak valid.');
        }

        $data = [
            'idpasien' => $idpasien,
            'tanggalkunjungan' => $tanggal,
            'keluhan' => trim($_POST['keluhan']),
            'diagnosis' => trim($_POST['diagnosis']),
            'totalkunjungan' => $total,
            'jumlahbayar' => $jumlahBayar,
            'kembalian' => $kembalian,
            'statuspembayaran' => $statusPembayaran,
            'statuskunjungan' => $statusKunjungan
        ];

        $hasil = $this->kunjungan->ubah($id, $data);

        if ($hasil) {
            header('Location: index.php?module=kunjungan');
            exit;
        }

        die('Gagal memperbarui data kunjungan.');
    }

    // Menampilkan detail kunjungan
    public function show($id)
    {
        $kunjungan = $this->kunjungan->ambil($id);

        if (!$kunjungan) {
            die('Data kunjungan tidak ditemukan.');
        }

        require 'views/Kunjungan/show.php';
    }

    // Menghapus data kunjungan
    public function delete($id)
    {
        $kunjungan = $this->kunjungan->ambil($id);

        if (!$kunjungan) {
            die('Data kunjungan tidak ditemukan.');
        }

        $hasil = $this->kunjungan->hapus($id);

        if ($hasil) {
            header('Location: index.php?module=kunjungan');
            exit;
        }

        die('Gagal menghapus data kunjungan.');
    }
}

