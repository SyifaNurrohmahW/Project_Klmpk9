<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ze Beauty's!</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-section {
            background-image: url('img/bg2.png');
            height: 500px;
        }
    </style>
</head>
<body>
<div class="bg-section">
    <div class="input">
        <h1 class="font-italic pt-4" style="text-align: center;">Login</h1>
        <form action="proses_login.php" method="POST" style="background-color: white; padding: 20px; border-radius: 10px; max-width: 500px; margin: 40px auto; color: #4B3621; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <div class="box-input">
                <label for="identifier">Username or Email: </label>
                <input type="text" name="identifier" placeholder="Username or Email" style="width: calc(100% - 20px); background-color: #582f0e; color: white; margin-bottom: 30px;">
            </div>
            <div class="box-input">
                <label for="password">Password: </label>
                <input type="password" name="password" placeholder="Password" style="width: calc(100% - 20px); background-color: #582f0e; color: white; margin-bottom: 30px;">
            </div>
            <button type="submit" name="login" class="btn-input" style="background-color: #a98467;  border-radius: 10px; color: white; margin-top: 5px; margin-bottom: 5px; border-color:transparent">Login</button>
            <div class="bottom">
                <p style="text-align: center; margin-top: 20px;">Belum punya akun?
                    <a style="color: black; font-weight: bold;" href="signup.php">Register disini</a>
                </p>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>