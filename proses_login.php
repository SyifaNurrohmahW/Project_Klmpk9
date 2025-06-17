<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = trim($_POST['identifier']); // bisa username (nama) atau email
    $password = $_POST['password'];

    // Cek apakah identifier adalah email atau username (nama)
    if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM pengguna WHERE email = ?";
    } else {
        $query = "SELECT * FROM pengguna WHERE nama = ?";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Simpan data user ke session
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama'] = $user['nama'];

            // Arahkan ke dashboard yang sesuai
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: profile.php");
            }
            exit();
        } else {
            echo "<script>alert('Password salah'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Akun tidak ditemukan'); window.location='login.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-image:url('img/bg2.png'); /* warna coklat susu muda */
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: #d32f2f;
            margin-bottom: 15px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: #ffffff;
            background-color: #582f0e;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #7a4b2e;
        }
        .button a {
            color: #ffffff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($error_message)) { echo "<p class='error'>{$error_message}</p>"; } ?>
        <button class="button"><a href='login.php'>Login</a></button>
    </div>
</body>
</html>