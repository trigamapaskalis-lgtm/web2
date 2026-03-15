<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <style>
        /* Global Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        
        body {
            background: url('https://images.unsplash.com/photo-1513002749550-c59d786b8e6c?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; background-attachment: fixed;
            height: 100vh; display: flex; overflow: hidden;
        }

        /* Sidebar Glassmorphism */
        .sidebar {
            width: 260px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            display: flex; flex-direction: column; padding: 30px 20px;
        }

        .sidebar h2 { font-size: 22px; color: #1a1a1a; margin-bottom: 40px; text-align: center; }

        .nav-menu { list-style: none; flex-grow: 1; }
        .nav-item { 
            padding: 15px; margin-bottom: 10px; border-radius: 12px; 
            cursor: pointer; transition: 0.3s; color: #333; font-weight: 500;
        }
        .nav-item.active, .nav-item:hover {
            background: rgba(255, 255, 255, 0.5); box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .logout-btn {
            padding: 15px; color: #e74c3c; text-decoration: none; font-weight: bold;
            border-radius: 12px; transition: 0.3s; margin-top: auto;
        }
        .logout-btn:hover { background: rgba(231, 76, 60, 0.1); }

        /* Main Content Area */
        .main-content {
            flex-grow: 1; padding: 40px; overflow-y: auto;
        }

        .top-bar {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;
        }

        .top-bar h1 { color: #1a1a1a; font-size: 28px; }

        .user-profile {
            background: rgba(255, 255, 255, 0.5); padding: 8px 18px;
            border-radius: 30px; backdrop-filter: blur(10px); 
            display: flex; align-items: center; gap: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Glass Cards for Table */
        .glass-container {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(15px);
            border-radius: 20px; padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { text-align: left; padding: 15px; border-bottom: 2px solid rgba(0,0,0,0.05); color: #222; }
        td { padding: 15px; border-bottom: 1px solid rgba(0,0,0,0.03); color: #444; vertical-align: middle; }

        .upload-box {
            background: rgba(255, 255, 255, 0.6); padding: 8px; border-radius: 10px; 
            display: flex; align-items: center; gap: 10px; border: 1px solid rgba(255,255,255,0.4);
        }
        
        .btn-send {
            background: #1a1a1a; color: white; border: none; padding: 8px 18px; 
            border-radius: 8px; cursor: pointer; font-weight: 600; transition: 0.2s;
        }
        .btn-send:hover { background: #333; transform: scale(1.02); }

        input[type="file"] { font-size: 12px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>E-Academic</h2>
        <ul class="nav-menu">
            <li class="nav-item">Dashboard</li>
            <li class="nav-item active">Daftar Tugas</li>
            <li class="nav-item">Materi</li>
            <li class="nav-item">Nilai</li>
        </ul>
        <a href="index.php?action=logout" class="logout-btn">Log Out</a>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h1>Daftar Tugas</h1>
            <div class="user-profile">
                <span>Welcome, <b><?= explode('@', $_SESSION['username'])[0] ?></b></span> 
                <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['username'] ?>&background=333&color=fff" width="35" style="border-radius: 50%;">
            </div>
        </div>

        <div class="glass-container">
            <table>
                <thead>
                    <tr>
                        <th>Tugas</th>
                        <th>Keterangan</th>
                        <th>Batas Waktu</th>
                        <th>Aksi Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($tugas) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($tugas)): ?>
                        <tr>
                            <td><b><?= $row['judul']; ?></b></td>
                            <td><small><?= $row['deskripsi']; ?></small></td>
                            <td><?= $row['deadline']; ?></td>
                            <td>
                                <form action="index.php?action=upload" method="POST" enctype="multipart/form-data" class="upload-box">
                                    <input type="hidden" name="id_tugas" value="<?= $row['id']; ?>">
                                    <input type="file" name="file_tugas" required style="width: 150px;">
                                    <button type="submit" name="submit_upload" class="btn-send">Kirim</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align:center; padding: 40px;">Tidak ada tugas hari ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>