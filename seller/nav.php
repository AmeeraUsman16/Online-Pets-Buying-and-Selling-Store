<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar position-sticky top-0 navbar-expand-lg bg-body-tertiary" style="margin-top:-10px; z-index: 100;">
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
                    <a class="nav-link fs-accent px-4 py-2 <?= ($current_page == 'add-pets.php') ? 'underline active' : '' ?>"
                        href="add-pets.php">Add Pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-accent px-4 py-2 <?= ($current_page == 'view-pets.php') ? 'underline active' : '' ?>"
                        href="view-pets.php">My Pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-accent px-4 py-2 <?= ($current_page == 'logout.php') ? 'underline active' : '' ?>"
                        href="logout.php">Logout

                    </a>
                </li>



                <a href='/pets/buyer/cart-pets.php' class="cart-container text-gray d-block"
                    style="position: relative;margin-top:10px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-shopping-cart">
                        <circle cx="8" cy="21" r="1" />
                        <circle cx="19" cy="21" r="1" />
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                    </svg>
                    <!-- Cart Items -->
                    <span id="cart-badge" class="badge" style="position: absolute; top: -5px;
   right: -10px; background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">0</span>
                </a>




            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartBadge = document.getElementById('cart-badge');

        // Function to update cart count
        function updateCartCount() {
            const cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
            cartBadge.textContent = cart.length; // Update badge count with the number of items
        }

        // Update cart count on page load
        updateCartCount();

        // Optional: If you have a mechanism to add/remove from cart, you can call updateCartCount() again
        // when the cart changes (e.g., after adding or removing an item from cart).
    });
</script>