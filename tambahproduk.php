<?php
include 'config.php';
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    // Upload gambar
    $gambar_name = $_FILES['profile_photo']['name'];
    $gambar_tmp = $_FILES['profile_photo']['tmp_name'];
    $target_dir = "uploads/";
    $gambar_path = $target_dir . basename($gambar_name);

    if (move_uploaded_file($gambar_tmp, $gambar_path)) {
        // Simpan data ke DB
        $insert = mysqli_query($conn, "INSERT INTO kategori_produk (nama, harga, urlgambar) 
            VALUES ('$nama', '$harga', '$gambar_name')");

        if ($insert) {
            echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan produk ke database.');</script>";
        }
    } else {
        echo "<script>alert('Gagal upload gambar.');</script>";
    }
}
?>
