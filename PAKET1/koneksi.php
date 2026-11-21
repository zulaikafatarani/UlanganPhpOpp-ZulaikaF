<?php

class Koneksi
{
    private $server = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $database = 'klinikpaketzulaika';

    protected $koneksi;

    public function __construct()
    {
        $this->koneksi = mysqli_connect(
            $this->server,
            $this->user,
            $this->pass,
            $this->database
        );

        if (!$this->koneksi) {
            die("Koneksi Gagal: " . mysqli_connect_error());
        }

        mysqli_set_charset($this->koneksi, "utf8mb4");
    }

    public function cekKoneksi()
    {
        if ($this->koneksi) {
            echo "Koneksi Berhasil";
        } else {
            echo "Koneksi Gagal";
        }
    }

    public function getKoneksi()
    {
        return $this->koneksi;
    }
}

$database = new Koneksi();

return $database->getKoneksi();
