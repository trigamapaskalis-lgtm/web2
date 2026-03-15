<?php
class UserModels {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Fungsi untuk Mahasiswa melihat daftar tugas
    public function getSemuaTugas() {
        $query = "SELECT * FROM tugas";
        return mysqli_query($this->db, $query);
    }

    // Di dalam class UserModels
    public function simpanUpload($id_tugas, $id_mhs, $nama_file) {
    // Sesuaikan nama tabelnya dengan yang baru kita buat: 'pengumpulan'
    $query = "INSERT INTO pengumpulan (id_tugas, id_mahasiswa, nama_file) 
              VALUES ('$id_tugas', '$id_mhs', '$nama_file')";
    return mysqli_query($this->db, $query);
}
}
?>