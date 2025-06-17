<?php
include("config.php");
session_start();

if (isset($_POST['daftar'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user'; // default: user

    // Validasi input
    if (empty($name) || empty($email) || empty($password)) {
        header('Location: signup.php?status=kosong');
        exit();
    }

    // Cek apakah email sudah terdaftar
    $check = $conn->prepare("SELECT id_pengguna FROM pengguna WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        header('Location: signup.php?status=email_terdaftar');
        exit();
    }
    $check->close();

    // Hash password dengan bcrypt
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data dengan prepared statement
    $stmt = $conn->prepare("INSERT INTO pengguna (nama, email, password, role) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;

            // Redirect sesuai role
            if ($role === 'admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: profile.php');
            }
            exit();
        } else {
            header('Location: signup.php?status=gagal');
            exit();
        }
    } else {
        die("Gagal mempersiapkan statement: " . $conn->error);
    }
} else {
    die("Akses dilarang...");
}
