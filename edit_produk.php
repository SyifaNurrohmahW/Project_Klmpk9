<?php

include 'config.php';
include 'navbaradmin.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit();
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM kategori_produk WHERE id_kategori = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f1ee;">
<div class="container mt-5">
    <h2 class="mb-4">Edit Produk</h2>
    <form action="prosesedit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_kategori" value="<?= $data['id_kategori'] ?>">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
        </div>
        <div class="form-group">
            <label>Gambar Sekarang</label><br>
            <img src="uploads/<?= $data['urlgambar'] ?>" width="100">
        </div>
        <div class="form-group">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="gambar" class="form-control-file">
        </div>
        <button type="submit" name="update" class="btn btn-success">Update Produk</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
