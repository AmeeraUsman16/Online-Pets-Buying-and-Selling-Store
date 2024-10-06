<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="margin-top:-10px">
    <div class="container-fluid" style="background-color: white;">
        <a class="navbar-brand" href="index.php"
            style="background-color: #FF6F61; color: white; font-weight: bold; padding:20px; border-radius: 5px;">
            Pet's Heaven
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link fs-accent btn px-4 py-2 <?= ($current_page == 'index.php') ? 'underline active' : '' ?>"
                        href="index.php">Home</a>
                </li>
             <li class="nav-item">
                    <a class="nav-link fs-accent btn px-4 py-2"  href="index.php" >Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-accent btn px-4 py-2" href="register.php" >Register</a>
                </li>
           
            </ul>
        </div>
    </div>
</nav>




