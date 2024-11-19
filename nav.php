<?php
$current_page = basename($_SERVER['PHP_SELF']);
$id = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
$userName = isset($_SESSION['name']) ? $_SESSION['name'] : null;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$searchQuery = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$hasSearchQuery = !empty($searchQuery);
?>

<nav class="navbar position-sticky top-0 navbar-expand-lg bg-body-tertiary"
    style="margin-top:-10px; z-index: 100;height:70px">
    <div class="container-fluid py-2 sm-py-0" style="background-color: white;">
        <?php if ($role === 'admin'): ?>
            <a class="navbar-brand" href="admin-dashboard.php" style="font-weight: bold; padding:20px; border-radius: 5px;">
                Pet's Heaven <img src="../assets/images/petLogo.jpg" style="height:40px" alt="pet Logo">
            </a>
        <?php else: ?>
            <a class="navbar-brand" href="index.php" style="font-weight: bold; padding:20px; border-radius: 5px;">
                Pet's Heaven <img src="assets/images/petLogo.jpg" style="height:40px" alt="pet Logo">
            </a>
        <?php endif; ?>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link fs-accent px-4 py-2 <?= ($current_page == 'index.php') ? 'underline active' : '' ?>"
                        href="<?= ($role == 'admin') ? 'dashboard.php' : 'index.php' ?>">Home</a>
                </li>
                <?php if ($role === 'seller'): ?>
                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2 <?= ($current_page == 'add-pets.php') ? 'underline active' : '' ?>"
                            href="add-pets.php">Add Pets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2 <?= ($current_page == 'my-pets.php') ? 'underline active' : '' ?>"
                            href="my-pets.php">My Pets</a>
                    </li>

                <?php endif; ?>
                <?php if ($role === 'buyer'): ?>

                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2  <?= ($current_page == 'view-pets.php') ? 'underline active' : '' ?>"
                            href="view-pets.php">Pets</a>
                    </li>
                <?php endif; ?>

                <?php if ($role === 'buyer'): ?>

                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2  <?= ($current_page == 'my-orders.php') ? 'underline active' : '' ?>"
                            href="my-orders.php">My Orders</a>
                    </li>

                <?php endif; ?>


                <?php if ($role === 'admin'): ?>

                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2" href="view-user.php"> View Users</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2" href="view-pets.php"> View Pets</a>

                    </li>

                <?php endif; ?>

                <?php if (empty($id)): ?>

                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2 <?= ($current_page == 'login.php') ? 'underline active' : '' ?>"
                            href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2" href="register.php">Register</a>
                    </li>

                <?php endif; ?>

                <?php if ($role === 'seller'): ?>
                    <li class="nav-item">
                        <a class="nav-link fs-accent px-4 py-2  <?= ($current_page == 'orders.php') ? 'underline active' : '' ?>"
                            href="orders.php">Orders</a>
                    </li>

                <?php endif; ?>


                <?php if (!empty($id)): ?>

                    <li class="nav-item">
                        <a class="nav-link text-danger fs-accent px-4 py-2" href="logout.php">Logout
                        </a>
                    </li>
                <?php endif; ?>




            </ul>
        </div>

        <?php if ($role === 'buyer'): ?>
            <a href='/pets/cart-pets.php' class="cart-container text-gray d-block max-w-fit me-3"
                style="position: relative;margin-top:7px">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-shopping-cart">
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                </svg>
                <!-- Cart Items -->
                <span id="cart-badge" class="badge"
                    style="position: absolute; top: -5px;
                             right: -10px; background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                    0
                </span>
            </a>
        <?php endif; ?>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if ($role !== 'admin'): ?>
            <div class="search-bar mx-auto sm:mx-0 mt-2">
                <form id="searchForm" action="view-pets.php" class='m-0' method="GET"
                    style="display: flex; align-items: center; width: 100%;">
                    <input type="text" name="search" id="searchInput" placeholder="Search..." value="<?= $searchQuery ?>"
                        required style="flex: 1; border: none; outline: none; padding-inline: 5px; font-size: 16px;" />
                    <?php if (isset($_GET['search']) && $_GET['search'] !== ''): ?>
                        <!-- Show the reset (cross) button if there's a search query -->
                        <a href="/pets/view-pets.php" id="resetSearch"
                            style="background: none; border: none; font-size: 15px; cursor: pointer; position: absolute" ;>
                            <i class="fa fa-times" style="color: red;"></i>
                        </a>
                    <?php else: ?>
                        <!-- Show the search button only if there's no search query -->
                        <button type="submit"
                            style="background: none; border: none; font-size: 15px; cursor: pointer; position: absolute;">
                            <i class="fa fa-search" style="color: gray;"></i>
                        </button>
                    <?php endif; ?>
                </form>
            </div>
        <?php endif; ?>

        <?php if ($role === 'buyer' || $role === 'seller'): ?>
            <div class='d-flex align-items-center gap-2 mx-auto'>
                <div class='ms-4 me-3 rounded-pill text-gray d-flex align-items-center'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-user">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <div class="ms-2">
                        <p class='mb-0 fs-6 text-accent truncate-username'><?= $userName ?></p>
                        <p class='mb-0 fs-7 lh-1'>
                            <?= ($role === 'seller') ? 'Seller' : 'Customer' ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartBadge = document.getElementById('cart-badge');
        // Function to update cart count
        function updateCartCount() {
            const cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
            cartBadge.textContent = cart?.length; // Update badge count with the number of items
        }

        // Update cart count on page load
        if (cartBadge) {
            updateCartCount();
        }

        // Optional: If you have a mechanism to add/remove from cart, you can call updateCartCount() again
        // when the cart changes (e.g., after adding or removing an item from cart).
    });
</script>

<head>
    <title>Font Awesome Icons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .search-bar {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 230px;
        border: 2px solid #ccc;
        border-radius: 20px;
        padding: 5px;
        background-color: white;
        position: relative;
        margin-bottom: 7px;
    }

    .search-bar input {
        border: none;
        outline: none;
        padding-inline: 5px;
        font-size: 16px;
        flex: 1;
    }

    .search-bar button,
    .search-bar a {
        background: none;
        border: none;
        font-size: 15px;
        cursor: pointer;
        position: absolute;
        right: 10px;
        top: 10px color: #555;
    }

    .search-bar button:hover {
        color: #333;
    }
</style>