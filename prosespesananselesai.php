<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama'] ?? '';
    $id_kategori = intval($_POST['id_kategori'] ?? 0);

    if (!empty($nama_produk) && $id_kategori > 0 && isset($_FILES['gambar'])) {
        $uploadDir = "uploads/";
        $fileName = basename($_FILES['gambar']['name']);
        $targetPath = $uploadDir . $fileName;

        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
                // Simpan ke DB
                $stmt = $conn->prepare("INSERT INTO produk (nama_produk, url_gambar, id_kategori) VALUES (?, ?, ?)");
                $stmt->bind_param("ssi", $nama_produk, $targetPath, $id_kategori);

                if ($stmt->execute()) {
                    header("Location: pesananselesai.php?id_kategori=" . $id_kategori);
                    exit();
                } else {
                    echo "Gagal menyimpan ke database: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Gagal mengunggah gambar.";
            }
        } else {
            echo "Format gambar tidak diperbolehkan.";
        }
    } else {
        echo "Data tidak lengkap atau tidak valid.";
    }

    $conn->close();
} else {
    echo "Akses tidak sah.";
}
