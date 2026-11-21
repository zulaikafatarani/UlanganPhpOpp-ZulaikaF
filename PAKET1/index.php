<?php

// Menggunakan Namespace
use App\Controllers\PasienController;

// Memulai session
session_start();

// Memanggil Composer Autoload
require_once __DIR__ . '/vendor/autoload.php';

// Memanggil koneksi database
$koneksi = require __DIR__ . '/koneksi.php';

// Membuat Object Controller
$controller = new PasienController($koneksi);

// Mengambil action dari URL
$action = $_GET['action'] ?? 'index';

// Mengambil ID dari URL
$id = $_GET['id'] ?? null;

// Mengatur alur aplikasi
switch ($action) {

    case 'index':
        $controller->index();
        break;

    case 'create':
        $controller->create();
        break;

    case 'store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        } else {
            header("Location: index.php");
            exit;
        }
        break;

    case 'edit':
        if ($id !== null && ctype_digit((string) $id) && (int) $id > 0) {
            $controller->edit((int) $id);
        } else {
            header("Location: index.php");
            exit;
        }
        break;

    case 'update':
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            $id !== null &&
            ctype_digit((string) $id) &&
            (int) $id > 0
        ) {
            $controller->update((int) $id);
        } else {
            header("Location: index.php");
            exit;
        }
        break;

    case 'show':
        if ($id !== null && ctype_digit((string) $id) && (int) $id > 0) {
            $controller->show((int) $id);
        } else {
            header("Location: index.php");
            exit;
        }
        break;

    case 'delete':
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            $id !== null &&
            ctype_digit((string) $id) &&
            (int) $id > 0
        ) {
            $controller->delete((int) $id);
        } else {
            header("Location: index.php");
            exit;
        }
        break;

    default:
        header("Location: index.php");
        exit;
}
