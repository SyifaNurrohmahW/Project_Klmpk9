<?php

include 'config.php';
include 'navbaradmin.php';

// Cek jika user bukan admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil semua produk
$query = mysqli_query($conn, "SELECT * FROM kategori_produk ORDER BY id_kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ze Beauty's!</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f1ee;">
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color:#4B3621;"><strong>Admin Dashboard</strong></h2>

    <!-- Form Tambah Produk -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">Tambah Produk</div>
        <div class="card-body">
            <form action="tambahproduk.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="harga" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Upload Gambar</label>
                    <input type="file" name="profile_photo" accept="image/*" style="width: calc(100% - 20px); background-color: #582f0e; color: white;"/>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Tambah Produk</button>
            </form>
        </div>
    </div>

    <!-- Daftar Produk -->
    <!-- Daftar Produk -->
<div class="card">
    <div class="card-header bg-dark text-white">Daftar Produk</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td><img src="uploads/<?= $row['urlgambar'] ?>" alt="" width="60"></td>
                    <td>
                        <a href="edit_produk.php?id=<?= $row['id_kategori'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_produk.php?id=<?= $row['id_kategori'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</body>
</html>
