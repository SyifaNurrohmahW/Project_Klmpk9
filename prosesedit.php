<?php
include 'config.php';

if (isset($_POST['update'])) {
    $id = intval($_POST['id_kategori']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = intval($_POST['harga']);

    // Cek apakah user upload gambar baru
    if ($_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $path = "uploads/" . $gambar;

        // Upload gambar
        if (move_uploaded_file($tmp, $path)) {
            // Update dengan gambar
            $update = mysqli_query($conn, "UPDATE kategori_produk SET nama='$nama', harga='$harga', urlgambar='$gambar' WHERE id_kategori=$id");
        } else {
            echo "Gagal upload gambar.";
            exit();
        }
    } else {
        // Update tanpa ganti gambar
        $update = mysqli_query($conn, "UPDATE kategori_produk SET nama='$nama', harga='$harga' WHERE id_kategori=$id");
    }

    if ($update) {
        header("Location: admin_dashboard.php?pesan=update_sukses");
    } else {
        echo "Gagal update data.";
    }
} else {
    echo "Akses tidak valid.";
}
