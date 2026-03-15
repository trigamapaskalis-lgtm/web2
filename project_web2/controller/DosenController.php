<?php
class DosenController {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function index() {
        $query = "SELECT * FROM tugas";
        $tugas = mysqli_query($this->db, $query);
        include 'views/dosen_tugas.php';
    }

    public function tambah() {
        if (isset($_POST['submit_tugas'])) {
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $deadline = $_POST['deadline'];

            $query = "INSERT INTO tugas (judul, deskripsi, deadline) VALUES ('$judul', '$deskripsi', '$deadline')";
            mysqli_query($this->db, $query);
            header("Location: index.php");
        }
    }

    public function hapus() {
        $id = $_GET['id'];
        mysqli_query($this->db, "DELETE FROM tugas WHERE id = '$id'");
        header("Location: index.php");
    }
}