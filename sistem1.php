<?php
// ===============================
// BAGIAN 1 & 2 - CLASS USER
// Constructor + Encapsulation
// ===============================

class User {
    // Encapsulation (private)
    private $nama;
    private $email;

    // Constructor
    public function __construct($nama, $email) {
        $this->nama = $nama;
        $this->email = $email;
    }

    // Setter & Getter Nama
    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function getNama() {
        return $this->nama;
    }

    // Setter & Getter Email
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    // Method untuk menampilkan data
    public function tampilUser() {
        return "Nama: " . $this->nama . "<br>Email: " . $this->email . "<br>";
    }
}


// ===============================
// BAGIAN 3 - INHERITANCE
// ===============================

// Class Mahasiswa turunan dari User
class Mahasiswa extends User {
    private $nim;

    public function __construct($nama, $email, $nim) {
        parent::__construct($nama, $email); // panggil constructor parent
        $this->nim = $nim;
    }

    public function getNim() {
        return $this->nim;
    }

    public function tampilMahasiswa() {
        return parent::tampilUser() . "NIM: " . $this->nim . "<br><br>";
    }
}


// Class Dosen turunan dari User
class Dosen extends User {
    private $nidn;

    public function __construct($nama, $email, $nidn) {
        parent::__construct($nama, $email); // panggil constructor parent
        $this->nidn = $this->nidn = $nidn;
    }

    public function getNidn() {
        return $this->nidn;
    }

    public function tampilDosen() {
        return parent::tampilUser() . "NIDN: " . $this->nidn . "<br><br>";
    }
}


// ===============================
// MEMBUAT OBJECT
// ===============================

$mahasiswa1 = new Mahasiswa("Paskalis Trigama Rosario", "pascal@email.com", "32241006");
$dosen1 = new Dosen("Rusdi Sutrino", "rusdi@email.com", "21134586");

// ===============================
// MENAMPILKAN DATA
// ===============================

echo "<h2>Data Mahasiswa</h2>";
echo $mahasiswa1->tampilMahasiswa();

echo "<h2>Data Dosen</h2>";
echo $dosen1->tampilDosen();

?>