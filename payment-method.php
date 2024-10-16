<?php
// Start the session
session_start();

// Include the database connection
require 'db.php';

// Initialize variables for storing form submission data
$error_message = '';
$success_message = '';
$id = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fullname = trim($_POST['name']);
    $cardNumber = trim($_POST['cardNumber']);
    $expiry = trim($_POST['expiry']);
    $cvc = trim($_POST['CVC']);
    $paymentMethod = isset($_POST['options-outlined']) ? $_POST['options-outlined'] : '';

    // Variable to store last 4 digits of the card, initially set to null
    $last4 = null;

    // Validate the card number (only if payment method is "Card")
    if ($paymentMethod === 'success-outlined') {
        if (!preg_match('/^\d{16}$/', $cardNumber)) {
            $error_message .= "Invalid card number. Please enter a valid 16-digit card number.<br>";
        } else {
            // Store the last 4 digits of the card number
            $last4 = substr($cardNumber, -4);
        }

        // Validate other card details
        if (empty($expiry)) {
            $error_message .= "Card expiry date is required.<br>";
        }

        if (empty($cvc) || !preg_match('/^\d{3,4}$/', $cvc)) {
            $error_message .= "Invalid CVC code.<br>";
        }
    }

    // Validate other fields (basic validation)
    if (empty($fullname)) {
        $error_message .= "Full name is required.<br>";
    }

    // Proceed if there are no errors
    if (empty($error_message)) {
        // Retrieve cart data and order details from the POST request
        $cart = json_decode($_POST['cart'], true);
        $orderDetails = json_decode($_POST['orderDetails'], true);

        // Initialize total price and order details
        $totalPrice = 0;
        $customerName = $orderDetails['fullname'];
        $address = $orderDetails['address'];
        $postalCode = $orderDetails['postalcode'];
        $phone = $orderDetails['phone'];

        // Calculate total price from cart
        foreach ($cart as $item) {
            $totalPrice += (float) $item['price'];
        }

        // Prepare to insert into orders table
        $stmt = $db->prepare("INSERT INTO orders (total_price, customer_id, payment_method, customer_name, address, customer_phone, postal_code, last4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $customerId = $id; // Replace with actual customer ID from session or database

        // Bind parameters for the orders insert
        $stmt->bind_param("dissssss", $totalPrice, $customerId, $paymentMethod, $customerName, $address, $phone, $postalCode, $last4);

        // Execute and check if order insertion is successful
        if ($stmt->execute()) {
            $orderId = $stmt->insert_id; // Get the last inserted order ID

            // Prepare to insert order items
            foreach ($cart as $item) {
                $itemStmt = $db->prepare("INSERT INTO order_items (order_id, petID, price, image, name, breed, description) VALUES (?, ?, ?, ?, ?, ?, ?)");

                // Ensure the parameters are properly set and bind
                $description = 'Description'; // You can customize this as needed

                // Corrected bind_param with appropriate types, ensuring the `image` (string) is handled properly
                $itemStmt->bind_param("iisssss", $orderId, $item['id'], $item['price'], $item['image'], $item['type'], $item['breed'], $description);

                // Execute and check if order item insertion is successful
                if (!$itemStmt->execute()) {
                    $error_message .= "Error inserting item {$item['id']}: " . $itemStmt->error . "<br>";
                }

                $itemStmt->close(); // Close the item statement
            }

            if (empty($error_message)) {
                $success_message = "Order placed successfully!";
            }
        } else {
            $error_message = "Error placing order: " . $stmt->error;
        }

        $stmt->close(); // Close the main statement
        $db->close(); // Close the database connection
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="./assets/css/index.css">
    <style>
        .body-style {
            max-width: 700px;
            margin: auto;

        }

        .payment-cards {
            max-width: 100px;
            top: 18px;
            right: 10px;
        }

        .pay-btn {
            background-color: #5469d4;
        }
    </style>
</head>

<body>
    <?php require_once 'nav.php'; //Include Navigation bar ?>
    <div class="body-style">
        <div class="container mt-4">
            <!-- Credit Cards Section -->
            <form action="" method="post" class='pt-1 payment-form shadow-sm p-4 rounded'>
                <input type="hidden" name="cart" id="cartData"
                    value='<?php echo htmlspecialchars(json_encode($_SESSION['cart'])); ?>'>
                <input type="hidden" name="orderDetails" id="orderDetails"
                    value='<?php echo htmlspecialchars(json_encode($_SESSION['orderDetails'])); ?>'>

                <div class="col-12 mt-4">
                    <div class="card border-0 p-3 border-bottom">
                        <p class="mb-0 fw-bold h4">Payment Methods</p>
                        <div class='mt-3'>
                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined"
                                autocomplete="off" checked>
                            <label class="btn shadow-sm border text-start ps-3 text-gray" style='width: 120px'
                                for="success-outlined">
                                <svg class='me-1' xmlns="http://www.w3.org/2000/svg" width="28" height="25"
                                    viewBox="0 0 24 24" fill="none" stroke="#ff9c9c" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card">
                                    <rect width="20" height="14" x="2" y="5" rx="2" />
                                    <line x1="2" x2="22" y1="10" y2="10" />
                                </svg><br> Card</label>
                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined1"
                                autocomplete="off">
                            <label class="btn ms-2 shadow-sm border text-start ps-3 text-gray" for="success-outlined1"
                                style='width: 170px'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                    fill="none" stroke="#aeaefd" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-banknote">
                                    <rect width="20" height="12" x="2" y="6" rx="2" />
                                    <circle cx="12" cy="12" r="2" />
                                    <path d="M6 12h.01M18 12h.01" />
                                </svg> <br> Cash On Delivery</label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3 mt-4">
                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="name" required
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px">
                    <label for="floatingName">Full Name</label>
                </div>

                <div class="form-floating mb-3 position-relative">
                    <input type="text" name="cardNumber" class="form-control" id="floatingCardNumber"
                        placeholder="Card Number" required
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px">
                    <label for="floatingCardNumber">Card Number (1234 1234 1234 1234)</label>
                    <img class='payment-cards position-absolute' src="../assets/images/payment-cards.png" alt="">
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="form-floating mb-3 w-100">
                        <input type="text" name="expiry" class="form-control" id="floatingExpiry" placeholder="Expiry"
                            required style="border: none; border: 1px solid #cdcdcd; border-radius:8px">
                        <label for="floatingExpiry">Expiry (MM / YY)</label>
                    </div>
                    <div class="form-floating mb-3 w-100">
                        <input type="text" name="CVC" class="form-control" id="floatingCvc" placeholder="CVC" required
                            style="border: none; border: 1px solid #cdcdcd; border-radius:8px">
                        <label for="floatingCvc">CVC</label>
                    </div>
                </div>

                <button class="border-0 rounded pay-btn mt-3 shadow-sm text-white w-100 py-2" type="submit">Pay Now</button>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger mt-4" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <?php if ($success_message): ?>
                    <div class="alert alert-success mt-4" role="alert">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script>document.querySelector('form').addEventListener('submit', function () {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const orderDetails = JSON.parse(sessionStorage.getItem('orderDetails')) || {};

            document.getElementById('cartData').value = JSON.stringify(cart);
            document.getElementById('orderDetails').value = JSON.stringify(orderDetails);

        });</script>

    <script>
        var orderSuccess = <?php echo !empty($success_message) ? 'true' : 'false'; ?>;
        if (orderSuccess) {
            localStorage.removeItem('cart');
            sessionStorage.removeItem('orderDetails');
        }
    </script>

    <?php require_once './footer.php'; //Include Footer ?>
</body>

</html>