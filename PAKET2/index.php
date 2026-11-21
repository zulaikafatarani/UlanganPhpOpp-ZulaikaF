<?php

require_once 'vendor/autoload.php';

$koneksi = require 'koneksi.php';

use App\Controllers\PasienController;
use App\Controllers\KunjunganController;

// Membuat objek Controller
$pasienController = new PasienController($koneksi);
$kunjunganController = new KunjunganController($koneksi);

// Mengambil parameter URL
$module = $_GET['module'] ?? 'pasien';
$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Menentukan Controller berdasarkan module
if ($module === 'pasien') {

    switch ($action) {
        case 'index':
            $pasienController->index();
            break;

        case 'create':
            $pasienController->create();
            break;

        case 'store':
            $pasienController->store();
            break;

        case 'edit':
            $pasienController->edit($id);
            break;

        case 'update':
            $pasienController->update($id);
            break;

        case 'show':
            $pasienController->show($id);
            break;

        case 'delete':
            $pasienController->delete($id);
            break;

        default:
            die('Aksi pasien tidak ditemukan.');
    }

} elseif ($module === 'kunjungan') {

    switch ($action) {
        case 'index':
            $kunjunganController->index();
            break;

        case 'create':
            $kunjunganController->create();
            break;

        case 'store':
            $kunjunganController->store();
            break;

        case 'edit':
            $kunjunganController->edit($id);
            break;

        case 'update':
            $kunjunganController->update($id);
            break;

        case 'show':
            $kunjunganController->show($id);
            break;

        case 'delete':
            $kunjunganController->delete($id);
            break;

        default:
            die('Aksi kunjungan tidak ditemukan.');
    }

} else {
    die('Modul tidak ditemukan.');
}
