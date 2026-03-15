<?php
class AdminController {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function index() {
        $query = "SELECT * FROM users";
        $users = mysqli_query($this->db, $query);
        include 'views/admin_dashboard.php';
    }

    public function tambahUser() {
        if (isset($_POST['submit_user'])) {
            $username = $_POST['username'];
            $password = $_POST['password']; // Disarankan menggunakan password_hash di proyek asli
            $role = $_POST['role'];

            $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
            mysqli_query($this->db, $query);
            header("Location: index.php");
        }
    }

    public function hapusUser() {
        $id = $_GET['id'];
        mysqli_query($this->db, "DELETE FROM users WHERE id = '$id'");
        header("Location: index.php");
    }
}