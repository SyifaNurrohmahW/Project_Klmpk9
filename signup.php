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
            height: 600px;
        }
    </style>
</head>
<body>
<div class="bg-section">
    <header>
        <h1 class="font-italic pt-4" style="text-align: center; color:#582f0e;">Registration</h1>
    </header>
    <form action="proses_signup.php" method="POST" style="background-color: white; padding: 20px; border-radius: 10px; max-width: 500px; margin: 40px auto; color: #4B3621; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <fieldset>
            <p>
                <label for="name">Name: </label>
                <input type="text" name="name" required style="width: calc(100% - 20px); background-color: #582f0e; color: white;"/>
            </p>
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" required style="width: calc(100% - 20px); background-color: #582f0e; color: white;"/>
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="password" name="password" required style="width: calc(100% - 20px); background-color: #582f0e; color: white;"/>
            </p>
            <p>
                <label for="role">Role: </label>
                <select name="role" required style="width: 100%; background-color: #582f0e; color: white;">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
            </p>
            <p>
                <input type="submit" value="Daftar" name="daftar" style="background-color: #a98467; border-radius: 10px; color: white; margin-top: 5px; margin-bottom: 5px; border-color: transparent;"/>
            </p>
            <p style="text-align: center;">Already have an account?
                <a style="color: black; font-weight: bold;" href="login.php">Login</a>
            </p>
        </fieldset>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
