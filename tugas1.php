<?php
// Membuat class Mahasiswa
class Mahasiswa {
    // Property
    public $nama;
    public $nim;
    public $jurusan;

    // Constructor (opsional, agar langsung isi data saat buat object)
    public function __construct($nama, $nim, $jurusan) {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->jurusan = $jurusan;
    }

    // Method untuk menampilkan data
    public function tampildata() {
        echo "Nama    : " . $this->nama . "<br>";
        echo "NIM     : " . $this->nim . "<br>";
        echo "Jurusan : " . $this->jurusan . "<br>";
    }
}

// Membuat 1 object
$mahasiswa1 = new Mahasiswa("Andi", "12345", "Teknik Informatika");

// Menampilkan data
$mahasiswa1->tampildata();
?>