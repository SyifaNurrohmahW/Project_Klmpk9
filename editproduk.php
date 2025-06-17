<?php
include 'config.php';
include 'navbaradmin.php';

if (!isset($_GET['id'])) {
    echo "ID produk tidak ditemukan!";
    exit();
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data produk tidak ditemukan!";
    exit();
}

// Ambil semua kategori
$kategori_result = mysqli_query($conn, "SELECT * FROM kategori_produk");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #f4f1ee;">
<div class="container mt-5">
    <h2>Edit Produk</h2>
    <form action="prosesedit2.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">

        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama_produk']) ?>" required>
        </div>

        <div class="form-group">
            <label>Gambar Saat Ini</label><br>
            <?php if (!empty($data['url_gambar']) && file_exists('uploads/' . $data['url_gambar'])): ?>
                <img src="uploads/<?= htmlspecialchars($data['url_gambar']) ?>" width="100">
            <?php else: ?>
                <p><i>Gambar di Review Pelanggan</i></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Ganti Gambar (Opsional)</label>
            <input type="file" name="gambar" class="form-control-file">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while ($row = mysqli_fetch_assoc($kategori_result)): ?>
                    <option value="<?= $row['id_kategori'] ?>" <?= $row['id_kategori'] == $data['id_kategori'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
        <a href="daftarproduk.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
