<?php
include 'config.php';
include 'navbar.php';

// Proses form ulasan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $id_review = uniqid('rev_'); // Generate unique ID for review
    $id_pengguna = isset($_SESSION['id_pengguna']) ? intval($_SESSION['id_pengguna']) : 0;
    
    $id_produk = intval($_POST['id_produk']);
    $rating = intval($_POST['rating']);
    $komentar = $conn->real_escape_string($_POST['komentar']);

    $gambarName = '';
    if (isset($_FILES['gambar_review']) && $_FILES['gambar_review']['error'] === 0) {
        $gambarName = 'uploads/' . basename($_FILES['gambar_review']['name']);
        move_uploaded_file($_FILES['gambar_review']['tmp_name'], $gambarName);
    }

    $sqlInsert = "INSERT INTO review (id_review, id_produk, id_pengguna, gambar_review, rating, komentar)
                  VALUES ($id_produk, '$gambarName', $rating, '$komentar')";
    $conn->query($sqlInsert);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ze Beauty's!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="text-center font-weight-bold mb-4">Review Product Skincare</h2>
    <div class="row">
        <?php
        $sql = "SELECT * FROM produk WHERE id_kategori = 1";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()):
        ?>
        <div class="col-md-6 mb-4">
            <div class="card">
                <img src="<?= htmlspecialchars($row['url_gambar']) ?>" class="card-img-top" alt="Produk">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['nama_produk']) ?></h5>

                    <!-- Ulasan Form -->
                    <form method="post" enctype="multipart/form-data" class="mb-3">
                        <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                        <div class="form-group">
                            <label>Upload Gambar Ulasan</label>
                            <input type="file" name="gambar_riview" class="form-control-file" required>
                        </div>
                        <div class="form-group">
                            <label>Beri Rating (1–5)</label>
                            <select name="rating" class="form-control" required>
                                <option value="">Pilih Rating</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?> Bintang</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Komentar</label>
                            <textarea name="komentar" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="submit_review" class="btn btn-primary">Kirim Ulasan</button>
                    </form>

                    <!-- Tampilkan ulasan -->
                    <h6>Ulasan Pengguna:</h6>
                    <?php
                    $id = $row['id_produk'];
                    $ulasan = $conn->query("SELECT * FROM review WHERE id_produk = $id ORDER BY tanggal DESC");
                    if ($ulasan->num_rows > 0):
                        while ($u = $ulasan->fetch_assoc()):
                    ?>
                        <div class="border rounded p-2 mb-2 bg-white">
                            <img src="<?= htmlspecialchars($u['gambar_ulasan']) ?>" style="height: 60px;" alt="ulasan">
                            <p class="mb-1">⭐ <?= $u['rating'] ?> / 5</p>
                            <p class="mb-1"><?= nl2br(htmlspecialchars($u['komentar'])) ?></p>
                            <small class="text-muted"><?= $u['tanggal'] ?></small>
                        </div>
                    <?php endwhile; else: ?>
                        <p class="text-muted">Belum ada ulasan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
