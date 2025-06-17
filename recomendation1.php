<?php 
include 'config.php';
include 'navbar.php';

// Ambil id_kategori dari URL (jika ada)
$id_kategori = isset($_GET['id_kategori']) ? intval($_GET['id_kategori']) : null;
$kategori_valid = true;

// Jika ada id_kategori, cek apakah valid
if ($id_kategori) {
    $stmt_check = $conn->prepare("SELECT nama FROM kategori_produk WHERE id_kategori = ?");
    $stmt_check->bind_param("i", $id_kategori);
    $stmt_check->execute();
    $stmt_check->store_result();
    $kategori_valid = $stmt_check->num_rows > 0;
    $stmt_check->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ze Beauty's!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .bg-section {
            background-image: url('img/bg2.png');
            background-size: cover;
            background-position: center;
            color: #582f0e;
        }
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
            height: 400px; 
            width: 380px;
            display: flex;
            flex-direction: column;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: contain;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #582f0e;
            flex-grow: 1; 
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .btn-primary {
            background-color: #582f0e;
            border-color: #582f0e;
            transition: background-color 0.2s, border-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #7a4b2e;
            border-color: #7a4b2e;
        }
    </style>
</head>
<body>
<div class="bg-section">
    <div class="container">
        <h1 class="text-center font-italic bold py-3">Review All Products</h1>
        <div class="row">

        <?php if (!$kategori_valid): ?>
            <div class="col-12"><p class="text-center text-danger">Kategori tidak ditemukan.</p></div>
        <?php else: ?>

            <?php
            // Ambil produk sesuai kategori jika ada, atau semua jika tidak
            if ($id_kategori) {
                $stmt = $conn->prepare("SELECT * FROM produk WHERE id_kategori = ? ORDER BY id_produk DESC");
                $stmt->bind_param("i", $id_kategori);
            } else {
                $stmt = $conn->prepare("SELECT * FROM produk ORDER BY id_produk DESC");
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card mb-4 shadow-sm w-100">
                        <img src="uploads/<?= htmlspecialchars($row["url_gambar"]) ?>" class="card-img-top" alt="<?= htmlspecialchars($row["nama_produk"]) ?>">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($row["nama_produk"]) ?></h5>
                            <div class="mt-auto d-flex justify-content-between">
                                <a href="add_review.php?id_produk=<?= intval($row["id_produk"]) ?>&id_kategori=<?= intval($row["id_kategori"]) ?>" class="btn btn-primary">Add Review</a>
                                <a href="add_review_process.php?id_produk=<?= intval($row["id_produk"]) ?>" class="btn btn-secondary">See Review</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
            else:
                echo "<div class='col-12'><p class='text-center'>Tidak ada produk ditemukan.</p></div>";
            endif;

            $stmt->close();
            ?>

        <?php endif; ?>
        </div>
    </div>
</div>

<!-- Script Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
