<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Amankan ID

    // Ambil nama file gambar sebelum dihapus
    $get = mysqli_query($conn, "SELECT url_gambar FROM produk WHERE id_produk = $id");
    $data = mysqli_fetch_assoc($get);
    $gambar = $data['url_gambar'];

    // Hapus terlebih dahulu semua review terkait
    $delete_reviews = mysqli_query($conn, "DELETE FROM review WHERE id_produk = $id");

    if (!$delete_reviews) {
        echo "Gagal menghapus review: " . mysqli_error($conn);
        exit();
    }

    // Hapus data produk
    $query = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id");

    if ($query) {
        // Hapus file gambar jika ada
        $file_path = "uploads/$gambar";
        if (!empty($gambar) && file_exists($file_path)) {
            unlink($file_path);
        }
        header("Location: pesananselesai.php?pesan=hapus_sukses");
        exit(); // penting untuk menghentikan eksekusi
    } else {
        echo "Gagal menghapus produk: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
