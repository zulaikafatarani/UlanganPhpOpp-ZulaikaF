<?php

namespace App\Controllers;

use App\Models\Pasien;

class PasienController
{
    private $pasien;

    public function __construct($koneksi)
    {
        $this->pasien = new Pasien($koneksi);
    }

    // Menampilkan seluruh data pasien
    public function index()
    {
        $dataPasien = $this->pasien->tampil();

        require 'views/Pasien/index.php';
    }

    // Menampilkan formulir tambah pasien
    public function create()
    {
        require 'views/Pasien/create.php';
    }

    // Menyimpan data pasien
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?module=pasien');
            exit;
        }

        $foto = '';

        if (
            !isset($_FILES['foto']) ||
            $_FILES['foto']['error'] !== UPLOAD_ERR_OK
        ) {
            die('Foto pasien wajib diunggah.');
        }

        $namaFile = $_FILES['foto']['name'];
        $tmpFile = $_FILES['foto']['tmp_name'];
        $ukuranFile = $_FILES['foto']['size'];

        $ekstensi = strtolower(
            pathinfo($namaFile, PATHINFO_EXTENSION)
        );

        $ekstensiDiizinkan = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ekstensi, $ekstensiDiizinkan)) {
            die('Format foto harus JPG, JPEG, PNG, atau WEBP.');
        }

        if ($ukuranFile > 2 * 1024 * 1024) {
            die('Ukuran foto maksimal 2 MB.');
        }

        $mime = mime_content_type($tmpFile);
        $mimeDiizinkan = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!in_array($mime, $mimeDiizinkan)) {
            die('File yang diunggah bukan gambar yang valid.');
        }

        $foto = uniqid('pasien_', true) . '.' . $ekstensi;

        $tujuan = 'assets/images/pasien/' . $foto;

        if (!move_uploaded_file($tmpFile, $tujuan)) {
            die('Gagal mengunggah foto pasien.');
        }

        $data = [
            'namapasien' => trim($_POST['namapasien']),
            'username' => trim($_POST['username']),
            'password' => $_POST['password'],
            'usia' => (int) $_POST['usia'],
            'alergi' => trim($_POST['alergi']),
            'jeniskelamin' => $_POST['jeniskelamin'],
            'alamat' => trim($_POST['alamat']),
            'nohp' => trim($_POST['nohp']),
            'foto' => $foto
        ];

        $hasil = $this->pasien->tambah($data);

        if ($hasil) {
            header('Location: index.php?module=pasien');
            exit;
        }

        if (file_exists($tujuan)) {
            unlink($tujuan);
        }

        die('Gagal menyimpan data pasien.');
    }

    // Menampilkan formulir edit pasien
    public function edit($id)
    {
        $pasien = $this->pasien->ambil($id);

        if (!$pasien) {
            die('Data pasien tidak ditemukan.');
        }

        require 'views/Pasien/edit.php';
    }

    // Memperbarui data pasien
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?module=pasien');
            exit;
        }

        $pasienLama = $this->pasien->ambil($id);

        if (!$pasienLama) {
            die('Data pasien tidak ditemukan.');
        }

        $foto = $pasienLama['foto'];
        $fotoBaru = false;
        $tujuan = '';

        if (
            isset($_FILES['foto']) &&
            $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
                die('Terjadi kesalahan saat mengunggah foto.');
            }

            $namaFile = $_FILES['foto']['name'];
            $tmpFile = $_FILES['foto']['tmp_name'];
            $ukuranFile = $_FILES['foto']['size'];

            $ekstensi = strtolower(
                pathinfo($namaFile, PATHINFO_EXTENSION)
            );

            $ekstensiDiizinkan = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ekstensi, $ekstensiDiizinkan)) {
                die('Format foto harus JPG, JPEG, PNG, atau WEBP.');
            }

            if ($ukuranFile > 2 * 1024 * 1024) {
                die('Ukuran foto maksimal 2 MB.');
            }

            $mime = mime_content_type($tmpFile);
            $mimeDiizinkan = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!in_array($mime, $mimeDiizinkan)) {
                die('File yang diunggah bukan gambar yang valid.');
            }

            $foto = uniqid('pasien_', true) . '.' . $ekstensi;
            $tujuan = 'assets/images/pasien/' . $foto;

            if (!move_uploaded_file($tmpFile, $tujuan)) {
                die('Gagal mengunggah foto baru.');
            }

            $fotoBaru = true;
        }

        $data = [
            'namapasien' => trim($_POST['namapasien']),
            'username' => trim($_POST['username']),
            'password' => $_POST['password'],
            'usia' => (int) $_POST['usia'],
            'alergi' => trim($_POST['alergi']),
            'jeniskelamin' => $_POST['jeniskelamin'],
            'alamat' => trim($_POST['alamat']),
            'nohp' => trim($_POST['nohp']),
            'foto' => $foto
        ];

        $hasil = $this->pasien->ubah($id, $data);

        if ($hasil) {
            if ($fotoBaru) {
                $fotoLama = 'assets/images/pasien/' .
                            $pasienLama['foto'];

                if (file_exists($fotoLama)) {
                    unlink($fotoLama);
                }
            }

            header('Location: index.php?module=pasien');
            exit;
        }

        if ($fotoBaru && file_exists($tujuan)) {
            unlink($tujuan);
        }

        die('Gagal memperbarui data pasien.');
    }

    // Menampilkan detail pasien
    public function show($id)
    {
        $pasien = $this->pasien->ambil($id);

        if (!$pasien) {
            die('Data pasien tidak ditemukan.');
        }

        require 'views/Pasien/show.php';
    }

    // Menghapus data pasien
    public function delete($id)
    {
        try {
            $pasien = $this->pasien->ambil($id);

            if (!$pasien) {
                die('Data pasien tidak ditemukan.');
            }

            $hasil = $this->pasien->hapus($id);

            if ($hasil) {
                $foto = 'assets/images/pasien/' . $pasien['foto'];

                if (file_exists($foto)) {
                    unlink($foto);
                }

                header('Location: index.php?module=pasien');
                exit;
            }

            die('Gagal menghapus data pasien.');
        } catch (\mysqli_sql_exception $e) {
            die(
                'Data pasien tidak dapat dihapus karena masih memiliki ' .
                'riwayat kunjungan. Hapus data kunjungan terlebih dahulu.'
            );
        }
    }
}

