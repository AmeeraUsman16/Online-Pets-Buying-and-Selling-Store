<?php
session_start();
require_once 'db.php'; // Ensure your database connection file is included

// Check if user is logged in and session stores their ID
if (!isset($_SESSION['userid'])) {
    // Redirect or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

$id = $_SESSION['userid'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/index.css">


    <style>
        .pet-img {
            width: 200px;
            border-radius: 10px;
            height: 50px;
            object-fit: cover;
        }

        .heading-style {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .detail {
            font-family: 'Roboto', sans-serif;
        }

        .tbl-container {
            max-width: 900px;
            display: flex;
        }

        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FAF0E6;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #4F000000 0 -3px 0 inset;
            box-sizing: border-box;
            color: #36395A;
            cursor: pointer;
            display: inline-flex;
            font-family: 'Roboto', sans-serif;
            height: 48px;
            justify-content: center;
            line-height: 1;
            list-style: none;
            overflow: hidden;
            padding-left: 16px;
            padding-right: 16px;
            position: relative;
            text-align: left;
            text-decoration: none;
            /* transition: box-shadow .15s, transform .15s; */
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            /* will-change: box-shadow, transform; */
            font-size: 18px;
            max-width: 400px;
        }

        .button-30:focus {
            box-shadow: #4F000000 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #4F000000 0 -3px 0 inset;
        }

        .button-30:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #4F000000 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-30:active {
            box-shadow: #4F000000 0 3px 7px inset;
            transform: translateY(2px);
        }
    </style>
</head>

<body style="background-color: rgb(245, 248, 250);">
    <!-- Navigation Bar -->
    <?php require_once 'nav.php'; ?>

    <h1 class="heading-style text-secondary detail">Your Cart</h1>
    <div class="container" style="max-width:900px;margin-bottom:80px">

        <table class="table" id="cart-table">
            <thead>
                <tr>
                    <th scope="col" class="text-secondary fs-6 fw-semibold detail">Petd</th>
                    <th scope="col" class="text-secondary fs-6 fw-semibold detail">Detail</th>
                    <th scope="col" class="text-secondary fs-6 fw-semibold detail">Total</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Cart items will be dynamically inserted here -->
            </tbody>
        </table>
        <div class='mb-5' style="max-width:280px;max-height:260px;margin-left:650px">
            <p class="text-secondary detail">Subtotal: <span id="subtotal">$0.00</span></p>
            <p style="font-size: 12px;" class="text-secondary">Taxes and shipping calculated at checkout</p>
            <a href='order-details.php' class="button-30" role="button" style="margin-left: 100px;"
                id="checkout-button">
                Checkout
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartTableBody = document.getElementById('cart-items');
            const subtotalElement = document.getElementById('subtotal');
            let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
            let subtotal = 0;

            // Function to populate cart items
            function populateCart() {
                cartTableBody.innerHTML = ''; // Clear the table body before inserting
                if (cart.length > 0) {
                    cart.forEach((item, index) => {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                        <td><img class="card-img-top pet-img text-gray" src="./uploads/${item.image || 'default.png'}" alt="Image Not Available" style="width:100px;"></td>
                        <td class="detail">
                            <span class="fs-5 text-secondary">${item.type}</span><br>
                            <span class="text-danger fs-7">${item.breed}</span><br>
                        </td>
                        <td class="text-secondary detail">$${item.price}</td>
                        <td>
                            <button 
                                class="bg-transparent p-0 border-0 mt-1"
                                onclick="removeFromCart(${index})"
                            >
                                <i class="material-icons cursor-pointer" style="font-size:25px;color:grey;margin-left:20px;">delete</i>
                            </button>
                        </td>
                    `;

                        cartTableBody.appendChild(row);

                        // Calculate subtotal
                        subtotal += parseFloat(item.price);
                    });
                    subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
                } else {
                    cartTableBody.innerHTML = '<tr><td colspan="4" class="text-center">No pets in your cart.</td></tr>';
                }
            }

            // Initialize the cart on page load
            populateCart();
        });

        // Function to remove an item from the cart
        function removeFromCart(index) {
            let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
            cart.splice(index, 1); // Remove the pet at the given index
            localStorage.setItem('cart', JSON.stringify(cart)); // Update localStorage
            document.dispatchEvent(new Event('DOMContentLoaded')); // Trigger re-populating of cart
        }
    </script>

    <?php require_once './footer.php'; //Include Footer ?>
</body>

</html>