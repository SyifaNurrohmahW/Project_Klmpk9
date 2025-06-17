<?php
include 'config.php';
include 'navbaradmin.php';

// Ambil data kategori untuk dropdown
$kategori_result = $conn->query("SELECT id_kategori, nama FROM kategori_produk");
?>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ze Beauty's!</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f1ee;">
    <div class="container mt-5">
    <h2><b>Input Produk (Pesanan Selesai)</b></h2>

    <form method="POST" action="prosespesananselesai.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama Produk:</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="gambar">Upload Gambar:</label>
            <input type="file" name="gambar" class="form-control-file" required>
        </div>

        <div class="form-group">
            <label for="id_kategori">Pilih Kategori:</label>
            <select name="id_kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while ($row = $kategori_result->fetch_assoc()): ?>
                    <option value="<?= $row['id_kategori'] ?>"><?= $row['nama'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Produk</button>
        
    <?php
// Tambahkan ini untuk mengambil daftar produk
$query = $conn->query("SELECT * FROM produk");
?>

<div class="card mt-4">
    <div class="card-header bg-dark text-white">Daftar Produk</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <body>
            <?php while($row = mysqli_fetch_assoc($query)): ?>
    <tr>
        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
        <td>
            <?php if (!empty($row['url_gambar']) && file_exists('uploads/' . $row['url_gambar'])): ?>
                <img src="uploads/<?= htmlspecialchars($row['url_gambar']) ?>" alt="gambar produk" width="60">
            <?php else: ?>
                <span><i>Gambar di Review Pelanggan</i></span>
            <?php endif; ?>
        </td>
        <td>
            <a href="editproduk.php?id=<?= $row['id_produk'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="hapusproduk.php?id=<?= $row['id_produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
        </td>
    </tr>
        <?php endwhile; ?>

            </body>
        </table>
    </div>
</div>

    </form>
</div>
</body>
</html>