<?php
session_start();
require_once 'models/database.php'; 

// Proses Logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Proses Login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
    } else {
        $error = "Username atau Password salah!";
    }
}

if (!isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Akademik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body {
            background: url('https://images.unsplash.com/photo-1513002749550-c59d786b8e6c?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; background-position: center;
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            padding: 40px; border-radius: 25px; width: 380px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.4);
            text-align: center;
        }
        .icon-box { background: white; width: 50px; height: 50px; margin: 0 auto 20px; 
                    display: flex; justify-content: center; align-items: center; 
                    border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); font-size: 24px; }
        h2 { color: #222; margin-bottom: 5px; }
        p { color: #666; font-size: 14px; margin-bottom: 30px; }
        input {
            width: 100%; padding: 15px; margin-bottom: 15px; border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.1); background: rgba(255,255,255,0.5); outline: none;
        }
        .btn {
            width: 100%; padding: 15px; background: #1a1a1a; color: white;
            border: none; border-radius: 10px; cursor: pointer; font-weight: 600; transition: 0.3s;
        }
        .btn:hover { background: #333; transform: translateY(-2px); }
        .error-msg { color: #e74c3c; font-size: 13px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="glass-card">
        <div class="icon-box">➔</div>
        <h2>SISTEM AKADEMIK</h2>
        <p>by Paskalis</p>
        
        <?php if(isset($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn">MULAI</button>
        </form>
    </div>
</body>
</html>
<?php
    exit();
}

$role = $_SESSION['role'];
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

// Pengecekan Role User sesuai Studi Kasus
if ($role == 'mahasiswa') {
    require_once 'controller/AuthController.php';
    $controller = new AuthController($conn);

    if ($action == 'upload') {
        $controller->prosesUpload();
    } else {
        $controller->index(); 
    }

} elseif ($role == 'admin') {
    require_once 'controller/AdminController.php';
    $controller = new AdminController($conn);

    if ($action == 'tambah_user') {
        $controller->tambahUser();
    } elseif ($action == 'hapus_user') {
        $controller->hapusUser();
    } else {
        $controller->index();
    }
    
} elseif ($role == 'dosen') {
    require_once 'controller/DosenController.php';
    $controller = new DosenController($conn);

    if ($action == 'tambah_tugas') {
        $controller->tambah();
    } elseif ($action == 'hapus_tugas') {
        $controller->hapus();
    } else {
        $controller->index();
    }
}
?>