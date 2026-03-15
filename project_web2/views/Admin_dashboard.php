<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - E-Academic</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body {
            background: url('https://images.unsplash.com/photo-1513002749550-c59d786b8e6c?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; background-attachment: fixed;
            height: 100vh; display: flex; overflow: hidden;
        }
        .sidebar { width: 260px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(20px); border-right: 1px solid rgba(255, 255, 255, 0.3); display: flex; flex-direction: column; padding: 30px 20px; }
        .main-content { flex-grow: 1; padding: 40px; overflow-y: auto; }
        .glass-card { background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(15px); border-radius: 20px; padding: 25px; border: 1px solid rgba(255, 255, 255, 0.3); margin-bottom: 20px; }
        input, select { width: 100%; padding: 12px; margin: 10px 0; border-radius: 10px; border: 1px solid rgba(0,0,0,0.1); background: rgba(255,255,255,0.6); }
        .btn { background: #1a1a1a; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>E-Academic</h2>
        <br>
        <ul style="list-style:none; flex-grow:1;">
            <li style="padding:15px; background:rgba(255,255,255,0.5); border-radius:10px;">User Management</li>
        </ul>
        <a href="index.php?action=logout" style="color:red; text-decoration:none; font-weight:bold;">Log Out</a>
    </div>

    <div class="main-content">
        <h1>User Management</h1>
        
        <div class="glass-card">
            <h3>Registrasi User Baru</h3>
            <form action="index.php?action=tambah_user" method="POST">
                <input type="text" name="username" placeholder="Username / Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role">
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="submit_user" class="btn">Simpan User</button>
            </form>
        </div>

        <div class="glass-card">
            <h3>Daftar Pengguna Sistem</h3>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)): ?>
                    <tr>
                        <td><?= $user['username'] ?></td>
                        <td><span style="text-transform: uppercase; font-size: 11px; font-weight: bold;"><?= $user['role'] ?></span></td>
                        <td>
                            <?php if($user['username'] != $_SESSION['username']): ?>
                                <a href="index.php?action=hapus_user&id=<?= $user['id'] ?>" style="color:red; text-decoration:none;" onclick="return confirm('Hapus user ini?')">Hapus</a>
                            <?php else: ?>
                                <span style="color:#888;">You</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>