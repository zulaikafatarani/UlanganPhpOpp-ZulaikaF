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

    // Menampilkan daftar pasien
    public function index()
    {
        $dataPasien = $this->pasien->tampil();

        require __DIR__ . '/../../views/Pasien/index.php';
    }

    // Menampilkan form tambah pasien
    public function create()
    {
        require __DIR__ . '/../../views/Pasien/create.php';
    }

    // Menampilkan form edit pasien
    public function edit($id)
    {
        $data = $this->pasien->ambil($id);

        if (!$data) {
            $this->redirect("Data pasien tidak ditemukan.", "gagal");
        }

        require __DIR__ . '/../../views/Pasien/edit.php';
    }

    // Menampilkan detail pasien
    public function show($id)
    {
        $data = $this->pasien->ambil($id);

        if (!$data) {
            $this->redirect("Data pasien tidak ditemukan.", "gagal");
        }

        require __DIR__ . '/../../views/Pasien/show.php';
    }

    // Memproses penambahan pasien
    public function store()
    {
        $data = $this->validasi($_POST, true);

        if ($data === false) {
            $this->redirect("Data tidak valid. Periksa kembali form.", "gagal");
        }

        // Upload foto pasien
        $foto = $this->uploadFoto($_FILES['foto'] ?? [], null, true);

        if ($foto === false) {
            $this->redirect(
                $_SESSION['pesan_upload'] ?? "Upload foto gagal.",
                "gagal"
            );
        }

        $data['foto'] = $foto;

        if ($this->pasien->tambah($data)) {
            $this->redirect("Data pasien berhasil ditambahkan.", "sukses");
        }

        // Hapus file jika penyimpanan database gagal
        $this->hapusFileFoto($foto);

        $this->redirect("Data pasien gagal ditambahkan.", "gagal");
    }

    // Memproses perubahan pasien
    public function update($id)
    {
        $pasienLama = $this->pasien->ambil($id);

        if (!$pasienLama) {
            $this->redirect("Data pasien tidak ditemukan.", "gagal");
        }

        $data = $this->validasi($_POST, false);

        if ($data === false) {
            $this->redirect("Data tidak valid. Periksa kembali form.", "gagal");
        }

        // Jika tidak memilih foto baru, gunakan foto lama
        $fotoLama = $pasienLama['foto'];

        $fotoBaru = $this->uploadFoto(
            $_FILES['foto'] ?? [],
            $fotoLama,
            false
        );

        if ($fotoBaru === false) {
            $this->redirect(
                $_SESSION['pesan_upload'] ?? "Upload foto gagal.",
                "gagal"
            );
        }

        $data['foto'] = $fotoBaru;

        if ($this->pasien->ubah($id, $data)) {

            // Hapus foto lama hanya jika foto berhasil diganti
            if ($fotoBaru !== $fotoLama) {
                $this->hapusFileFoto($fotoLama);
            }

            $this->redirect("Data pasien berhasil diperbarui.", "sukses");
        }

        // Jika database gagal diperbarui, hapus foto baru
        if ($fotoBaru !== $fotoLama) {
            $this->hapusFileFoto($fotoBaru);
        }

        $this->redirect("Data pasien gagal diperbarui.", "gagal");
    }

    // Memproses penghapusan pasien
    public function delete($id)
    {
        $data = $this->pasien->ambil($id);

        if (!$data) {
            $this->redirect("Data pasien tidak ditemukan.", "gagal");
        }

        if ($this->pasien->hapus($id)) {

            // Hapus foto setelah data berhasil dihapus
            $this->hapusFileFoto($data['foto']);

            $this->redirect("Data pasien berhasil dihapus.", "sukses");
        }

        $this->redirect("Data pasien gagal dihapus.", "gagal");
    }

    // Validasi data pasien
    private function validasi($input, $passwordWajib = true)
    {
        $nama = trim($input['namapasien'] ?? '');
        $username = trim($input['username'] ?? '');
        $password = $input['password'] ?? '';
        $usia = $input['usia'] ?? '';
        $alergi = trim($input['alergi'] ?? '');
        $jk = $input['jeniskelamin'] ?? '';
        $alamat = trim($input['alamat'] ?? '');
        $nohp = trim($input['nohp'] ?? '');

        if (
            $nama === '' ||
            strlen($nama) > 100 ||
            $username === '' ||
            strlen($username) > 100
        ) {
            return false;
        }

        if ($passwordWajib && $password === '') {
            return false;
        }

        if (strlen($password) > 255) {
            return false;
        }

        if (
            $usia === '' ||
            !ctype_digit((string) $usia) ||
            (int) $usia < 1 ||
            (int) $usia > 150
        ) {
            return false;
        }

        if ($alergi === '' || strlen($alergi) > 255) {
            return false;
        }

        if (!in_array($jk, ['Laki-laki', 'Perempuan'], true)) {
            return false;
        }

        if (strlen($alamat) > 255) {
            return false;
        }

        if (
            strlen($nohp) > 15 ||
            !preg_match('/^[0-9]*$/', $nohp)
        ) {
            return false;
        }

        return [
            'namapasien' => $nama,
            'username' => $username,
            'password' => $password,
            'usia' => (int) $usia,
            'alergi' => $alergi,
            'jeniskelamin' => $jk,
            'alamat' => $alamat,
            'nohp' => $nohp
        ];
    }

    // Mengunggah foto pasien
    private function uploadFoto($file, $fotoLama = null, $wajib = false)
    {
        if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {

            if ($wajib) {
                $_SESSION['pesan_upload'] = "Foto pasien wajib diunggah.";
                return false;
            }

            return $fotoLama;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['pesan_upload'] = "Terjadi kesalahan saat mengunggah foto.";
            return false;
        }

        // Maksimal ukuran foto 2 MB
        if ($file['size'] > 2 * 1024 * 1024) {
            $_SESSION['pesan_upload'] = "Ukuran foto maksimal 2 MB.";
            return false;
        }

        // Memeriksa tipe file berdasarkan MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $jenisFoto = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($jenisFoto[$mime])) {
            $_SESSION['pesan_upload'] =
                "Format foto harus JPG, JPEG, PNG, atau WEBP.";
            return false;
        }

        // Memastikan file benar-benar gambar
        if (getimagesize($file['tmp_name']) === false) {
            $_SESSION['pesan_upload'] = "File yang diunggah bukan gambar.";
            return false;
        }

        $folderFoto = __DIR__ . '/../../assets/images/pasien/';

        // Membuat folder jika belum tersedia
        if (!is_dir($folderFoto)) {
            mkdir($folderFoto, 0755, true);
        }

        // Membuat nama file unik
        $namaFile = bin2hex(random_bytes(16)) . '.' . $jenisFoto[$mime];

        $tujuan = $folderFoto . $namaFile;

        if (!move_uploaded_file($file['tmp_name'], $tujuan)) {
            $_SESSION['pesan_upload'] = "Foto gagal disimpan ke folder.";
            return false;
        }

        return $namaFile;
    }

    // Menghapus file foto dari folder
    private function hapusFileFoto($namaFile)
    {
        if ($namaFile === '') {
            return;
        }

        // Mengambil nama file saja agar tidak mengakses folder lain
        $namaFile = basename($namaFile);

        $lokasi = __DIR__ . '/../../assets/images/pasien/' . $namaFile;

        if (is_file($lokasi)) {
            unlink($lokasi);
        }
    }

    // Mengalihkan halaman dan menampilkan pesan
    private function redirect($pesan, $jenis)
    {
        $_SESSION['pesan'] = $pesan;
        $_SESSION['jenis'] = $jenis;

        unset($_SESSION['pesan_upload']);

        header("Location: index.php");
        exit;
    }
}
