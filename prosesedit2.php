<?php
include 'config.php';

if (isset($_POST['update'])) {
    $id = intval($_POST['id_produk']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);

    // Cek apakah user upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $gambar_new = time() . "_" . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $gambar);
        $path = "uploads/" . $gambar_new;

        // Upload gambar
        if (move_uploaded_file($tmp, $path)) {
            // Update dengan gambar
            $update = mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', url_gambar='$gambar_new' WHERE id_produk=$id");
        } else {
            echo "Gagal upload gambar.";
            exit();
        }
    } else {
        // Update tanpa ganti gambar
        $update = mysqli_query($conn, "UPDATE produk SET nama_produk='$nama' WHERE id_produk=$id");
    }

    if ($update) {
        header("Location: pesananselesai.php?pesan=update_sukses");
        exit();
    } else {
        echo "Gagal update data: " . mysqli_error($conn);
    }
} else {
    echo "Akses tidak valid.";
}
?>
