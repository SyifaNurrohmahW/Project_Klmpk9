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
                <a class="nav-link text-white" href="index.php">HOME</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownCategory" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    CATALOG
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownCategory">
                    <a class="dropdown-item" href="katalog.php">ALL PRODUCTS</a>
                </div>
            </li>
        
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownGRWU" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    GRWU
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownGRWU">
                    <a class="dropdown-item" href="grwu1.php">SKINCARE ROUTINE</a>
                    <a class="dropdown-item" href="grwu2.php">MAKE UP TUTORIAL</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownGRWU" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    REVIEW
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownGRWU">
                    <a class="dropdown-item" href="recomendation1.php">REVIEW PRODUCTS</a>
                    
                </div>
            </li>
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownJoinUs" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        MEMBER AREA
                    <?php else: ?>JOIN US
                       
                    <?php endif; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownJoinUs">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a class="dropdown-item" href="profile.php">PROFILE</a>
                    <?php else: ?>
                        <a class="dropdown-item" href="signup.php">SIGN UP</a>
                        <a class="dropdown-item" href="profile.php">PROFILE</a>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </div>
</nav>