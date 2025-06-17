<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: signup.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $profile_photo = '';

    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
                $profile_photo = basename($_FILES["profile_photo"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    } elseif ($_FILES['profile_photo']['error'] != UPLOAD_ERR_NO_FILE) {
        echo "File upload error: " . $_FILES['profile_photo']['error'];
        exit();
    }

    // Update query
    $sql = "UPDATE pengguna SET nama = ?, email = ?, phone = ?";
    if ($profile_photo) {
        $sql .= ", profile_photo = ?";
    }
    $sql .= " WHERE id_pengguna = ?";

    $stmt = $conn->prepare($sql);
    if ($profile_photo) {
        $stmt->bind_param("ssssi", $nama, $email, $phone, $profile_photo, $user_id);
    } else {
        $stmt->bind_param("sssi", $nama, $email, $phone, $user_id);
    }

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
        exit();
    }

    $stmt->close();
}
?>
