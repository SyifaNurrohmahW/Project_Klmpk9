<?php
include 'config.php';
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_pengguna'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id_pengguna'];

// Proses form jika dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil dan validasi input
    $id_produk = isset($_POST['id_produk']) ? intval($_POST['id_produk']) : 0;
    $id_kategori = isset($_POST['id_kategori']) ? intval($_POST['id_kategori']) : 0;
    $skinType = isset($_POST['skin_type']) ? trim($_POST['skin_type']) : '';
    $usageDuration = isset($_POST['usage_duration']) ? trim($_POST['usage_duration']) : '';
    $komentar = isset($_POST['komentar']) ? trim($_POST['komentar']) : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;

    // Validasi input
    if ($id_produk <= 0 || $id_kategori <= 0 || $rating < 1 || $rating > 5 || empty($skinType) || empty($usageDuration) || empty($komentar)) {
        die("Data tidak lengkap atau tidak valid.");
    }

    // Cek apakah produk benar-benar ada
    $stmt = $conn->prepare("SELECT 1 FROM produk WHERE id_produk = ?");
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        die("Produk tidak ditemukan. Review tidak dapat disimpan.");
    }
    $stmt->close();

    // Simpan review ke database
    $stmt = $conn->prepare("INSERT INTO review (id_produk, id_pengguna, komentar, rating, skin_type, usage_duration) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $id_produk, $user_id, $komentar, $rating, $skinType, $usageDuration);

    if ($stmt->execute()) {
        // Berhasil, redirect kembali ke halaman review produk
        header("Location: add_review.php?id_produk=$id_produk&id_kategori=$id_kategori");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan review: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} 


// Tampilkan ulasan berdasarkan id_produk
if (isset($_GET['id_produk']) && is_numeric($_GET['id_produk'])) {
    $id_produk = intval($_GET['id_produk']);

    $stmt = $conn->prepare("SELECT nama_produk, id_kategori FROM produk WHERE id_produk = ?");
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if ($product) {
        $categoryId = $product['id_kategori'];

        $recommendationPage = "recomendation1.php";


        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Product Reviews</title>
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    background-image: url("img/bg2.png");
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: center;
                }
                .container { margin-top: 50px; }
                .review-card {
                    background-color: #fff;
                    border: 1px solid #e0e0e0;
                    border-radius: 8px;
                    padding: 20px;
                    margin-bottom: 20px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .profile {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    margin-bottom: 15px;
                }
                .profile img {
                    width: 100px;
                    height: 100px;
                    object-fit: cover;
                    border-radius: 50%;
                    border: 5px solid white;
                    margin-bottom: 10px;
                }
                .name {
                    font-size: 1.2em;
                    font-weight: bold;
                }
                .details, .review-text, .skin-usage {
                    font-size: 0.95em;
                    color: #333;
                    margin-top: 5px;
                }
                .stars {
                    color: #ffc107;
                    margin-top: 10px;
                }
                .recommend {
                    font-weight: bold;
                    color: #28a745;
                }
                .back-button {
                    background-color: #582f0e;
                    color: #fff;
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                }
            </style>
        </head>
        <body>
        <div class="container">
        <h1 class="mb-4">Reviews for ' . htmlspecialchars($product['nama_produk']) . '</h1>';

        $stmt = $conn->prepare("SELECT r.*, p.nama AS nama, p.profile_photo 
                                FROM review r 
                                LEFT JOIN pengguna p ON r.id_pengguna = p.id_pengguna 
                                WHERE r.id_produk = ?");
        $stmt->bind_param("i", $id_produk);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profileImg = $row['profile_photo'] ? 'uploads/' . $row['profile_photo'] : 'default_profile.png';
                echo '<div class="review-card">';
                echo '<div class="profile">';
                echo '<img src="' . htmlspecialchars($profileImg) . '" alt="Profile">';
                echo '<div class="name">' . htmlspecialchars($row['nama']) . '</div>';
                echo '<div class="details">"' . htmlspecialchars($row['komentar']) . '"</div>';
                echo '</div>';
                echo '<div class="review-content">';
                echo '<div class="stars">';
                for ($i = 1; $i <= 5; $i++) {
                    echo $i <= $row['rating'] ? '<span>★</span>' : '<span style="color:#ccc;">★</span>';
                }
                echo '</div>';
                echo '<div class="skin-usage">Skin Type: ' . htmlspecialchars($row['skin_type']) . ', Duration: ' . htmlspecialchars($row['usage_duration']) . '</div>';
                echo '<div class="recommend">' . htmlspecialchars($row['nama']) . ' recommends this product!</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No reviews available for this product.</p>";
        }

       echo '<a href="' . $recommendationPage . '" class="btn back-button">Back</a>';
       

        echo '</div></body></html>';
    } else {
        echo "<p>Produk tidak ditemukan.</p>";
    }

    $conn->close();
}
?>
