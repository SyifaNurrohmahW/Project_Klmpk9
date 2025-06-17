<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light" style="background-image: url('img/download (1).png');">
    <a class="navbar-brand" href="#">
        <img src="img/logo2.jpg" class="align-center rounded-circle" style="height: 90px; width: 90px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="admin_dashboard.php">HOME</a>
            </li>
            
         <li class="nav-item">
                <a class="nav-link text-white" href="pesananselesai.php">FINAL ORDER'S</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">LOGOUT</a>
            </li>
               
             </ul>
    </div>
</nav>