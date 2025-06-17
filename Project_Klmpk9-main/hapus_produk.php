<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Amankan ID

    // Ambil nama file gambar sebelum dihapus
    $get = mysqli_query($conn, "SELECT urlgambar FROM kategori_produk WHERE id_kategori = $id");
    $data = mysqli_fetch_assoc($get);
    $gambar = $data['urlgambar'];

    // Hapus data dari DB
    $query = mysqli_query($conn, "DELETE FROM kategori_produk WHERE id_kategori = $id");

    if ($query) {
        // Hapus file gambar jika ada
        $file_path = "uploads/$gambar";
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        header("Location: admin_dashboard.php");
        exit(); // penting untuk menghentikan eksekusi
    } else {
        echo "Gagal menghapus produk.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
