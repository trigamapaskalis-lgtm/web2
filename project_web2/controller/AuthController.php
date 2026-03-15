<?php
include_once 'models/UserModels.php';

class AuthController {
    private $model;

    public function __construct($conn) {
        $this->model = new UserModels($conn);
    }

    // Menampilkan halaman tugas mahasiswa
    public function index() {
        $tugas = $this->model->getSemuaTugas();
        include 'views/mahasiswa_tugas.php';
    }

    // Logika upload file
    public function prosesUpload() {
        if (isset($_POST['submit_upload'])) {
            $id_tugas = $_POST['id_tugas'];
            $id_mhs = $_SESSION['id_user']; // Mengambil ID dari session login
            
            $file_name = $_FILES['file_tugas']['name'];
            $file_temp = $_FILES['file_tugas']['tmp_name'];
            $folder = "uploads/" . $file_name;

            if (move_uploaded_file($file_temp, $folder)) {
                $this->model->simpanUpload($id_tugas, $id_mhs, $file_name);
                echo "<script>alert('Berhasil upload!'); window.location='index.php';</script>";
            }
        }
    }
}
?>