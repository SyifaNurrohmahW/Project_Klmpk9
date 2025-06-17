<?php
include 'config.php';
include 'navbar.php';


if (!isset($_SESSION['id_pengguna'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id_pengguna'];

// Ambil data pengguna
$query = "SELECT nama, profile_photo FROM pengguna WHERE id_pengguna = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    die("Pengguna tidak ditemukan.");
}

$user_name = $user['nama'];
$profile_photo = $user['profile_photo'] ? 'uploads/' . $user['profile_photo'] : 'default_profile.png';

// Validasi parameter GET
if (!isset($_GET['id_produk']) || !is_numeric($_GET['id_produk'])) {
    die("ID produk tidak valid.");
}

$id_produk = intval($_GET['id_produk']);

// Ambil id_kategori dari produk
$stmt = $conn->prepare("SELECT id_kategori, nama_produk FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();
$stmt->close();

if (!$produk) {
    die("Produk tidak ditemukan.");
}

$id_kategori = $produk['id_kategori'];
$nama_produk = $produk['nama_produk'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Review - <?php echo htmlspecialchars($nama_produk); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("img/bg2.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            margin-top: 60px;
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-submit {
            background-color: #582f0e;
            color: #fff;
        }
        .btn-submit:hover {
            background-color: #3e1e07;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Add Review for: <?php echo htmlspecialchars($nama_produk); ?></h2>

    <form action="add_review_process.php" method="POST">
        <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
        <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>">
        <input type="hidden" name="id_pengguna" value="<?php echo $user_id; ?>">

        <div class="form-group">
            <label for="userName">Your Name</label>
            <input type="text" class="form-control" id="userName" name="nama_pengguna" value="<?php echo htmlspecialchars($user_name); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="skin_type">Skin Type</label>
            <input type="text" class="form-control" id="skin_type" name="skin_type" required>
        </div>

        <div class="form-group">
            <label for="usage_duration">Usage Duration</label>
            <input type="text" class="form-control" id="usage_duration" name="usage_duration" required>
        </div>

        <div class="form-group">
            <label for="komentar">Review</label>
            <textarea class="form-control" id="komentar" name="komentar" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label>Rating</label><br>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" required>
                    <label class="form-check-label" for="star<?php echo $i; ?>"><?php echo str_repeat('★', $i); ?></label>
                </div>
            <?php endfor; ?>
        </div>

        <button type="submit" class="btn btn-submit">Submit Review</button>
    </form>
</div>

</body>
</html>
