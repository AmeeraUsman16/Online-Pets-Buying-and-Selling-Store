<nav class="navbar navbar-expand-lg bg-body-tertiary" style="margin-top:-10px">
    <div class="container-fluid" style="background-color: #0597a0;">
     <a class="navbar-brand" href="index.php" style="background-color: #0597a0; color: white; font-weight: bold; padding:20px; border-radius: 5px;">
            Pet's Heaven
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item ms-5">
                    <a class="nav-link btn btn-outline-light rounded-pill px-4 py-2" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item ms-5 mx-3">
                    <a class="nav-link btn btn-outline-light rounded-pill px-4 py-2" aria-current="page" href="add-pets.php" style="color: white;">Add Pets</a>
                </li>
                <li class="nav-item ms-5 mx-3">
                    <a class="nav-link btn btn-outline-light rounded-pill px-4 py-2" aria-current="page" href="view-pets.php" style="color: white;">My Pets</a>
                </li>
                <li class="nav-item ms-5 mx-3">
                    <a class="nav-link btn btn-outline-light rounded-pill px-4 py-2" aria-current="page" href="logout.php" style="color: white;">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<style>
    .navbar-nav .nav-link {
        color: white !important;
        transition: color 0.3s ease; /* Smooth transition for color change */
    }

    .navbar-nav .nav-link:hover {
        color: black !important;
    }
</style>

