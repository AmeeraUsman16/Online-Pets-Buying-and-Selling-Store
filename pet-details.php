<?php
session_start();
require_once 'db.php'; // Include the db configuration for connection

// Get the petID from the URL
$petID = isset($_GET['petID']) ? intval($_GET['petID']) : 0;
$id = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

if ($petID) {
    // Query to fetch pet details along with seller information
    $query = "SELECT p.*, u.name as sellerName, u.email as sellerEmail, u.number as sellerPhone
              FROM tblpets p 
              JOIN users u ON p.sellerId = u.uid
              WHERE p.petID = ?";

    // Prepare and execute the statement
    if ($stmt = mysqli_prepare($db, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $petID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $pet = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='alert alert-danger mb-0 mt-3'>Error preparing the query.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger mb-0 mt-3'>Invalid pet ID.</div>";
    exit;
}

// If the pet data is not found
if (!$pet) {
    header("Location: 404.php");
    exit;
}

// Check if the pet status is blocked
if ($pet['status'] === 'blocked') {
    header("Location: 404.php");
    exit;
}

// Check if the user is a buyer and has bought the pet
$hasBoughtPet = false;

if ($role === 'buyer') {
    // Query to check if the user has bought this pet
    $checkOrderQuery = "SELECT COUNT(*) AS hasBought
                        FROM order_items oi
                        JOIN orders o ON o.id = oi.order_id
                        WHERE oi.petID = ? AND o.customer_id = ?";

    if ($stmt = $db->prepare($checkOrderQuery)) {
        $stmt->bind_param("ii", $petID, $id);
        $stmt->execute();
        $stmt->bind_result($hasBought);
        $stmt->fetch();
        $hasBoughtPet = $hasBought > 0;
        $stmt->close();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review-button'])) {
    $review = htmlspecialchars(trim($_POST['review']));

    // Check if a review already exists
    $checkReviewQuery = "SELECT description FROM reviews WHERE petID = ? AND userID = ?";
    if ($stmt = $db->prepare($checkReviewQuery)) {
        $stmt->bind_param("ii", $petID, $id);
        $stmt->execute();
        $stmt->bind_result($existingReview);
        $stmt->fetch();
        $stmt->close();

        if (empty($existingReview)) {
            // Insert the review if it doesn't exist
            $insertReviewQuery = "INSERT INTO reviews (petID, userID, description) VALUES (?, ?, ?)";
            if ($stmt = $db->prepare($insertReviewQuery)) {
                $stmt->bind_param("iis", $petID, $id, $review);
                $stmt->execute();
                $stmt->close();

                $_SESSION['success_message'] = "Your pet review has been successfully added!";
                $_SESSION['error_message'] = ""; // Set empty error message if no error occurred
            } else {
                $_SESSION['success_message'] = "";
                $_SESSION['error_message'] = "There was an error submitting review!"; // Set empty error message if no error occurred
            }
        }
    }

    // Redirect to the same page after submission
    header("Location: pet-details.php?petID=$petID");
    exit;
}

$review = '';
$reviewQuery = "SELECT description FROM reviews WHERE petID = ?";
if ($stmt = $db->prepare($reviewQuery)) {
    $stmt->bind_param("i", $petID);
    $stmt->execute();
    $stmt->bind_result($review);
    $stmt->fetch();
    $stmt->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/index.css">
    <title>Pets Details</title>

    <style>
        .div-styl {
            background-color: red;
            margin-top: 100px;
        }
    </style>
</head>

<body style="background-color: rgb(245, 248, 250);">

    <?php include 'nav.php'; ?>

    <div class="container">
        <div class="mt-5 container rounded" style="background:rgba(255, 213, 205, 0.2)">
            <div class="row d-flex py-4 justify-content-between ps-4">
                <div class="col-md-6">
                    <img src="uploads/<?php echo htmlspecialchars($pet['image']); ?>" alt="Pets_image"
                        class="rounded w-100 object-cover h-100">
                </div>

                <div class="col-md-6 container ms-0 mt-4">
                    <div class="mt-2 d-flex justify-content-between">
                        <div class="text-secondary">
                            <h1 class='text-gray lh-1 text-capitalize'><?php echo htmlspecialchars($pet['petType']); ?>
                            </h1>
                            <h2 class='text-accent fw-medium fs-5 lh-1'><?php echo htmlspecialchars($pet['breed']); ?>
                            </h2>
                        </div>
                        <h3 class='text-gray me-3 mt-1 fs-4'>Price: <?php echo number_format($pet['price'], 2); ?></h3>
                    </div>
                    <p class="mt-3 text-secondary"><?php echo htmlspecialchars($pet['description']); ?></p>
                    <?php if ($role === 'buyer'): ?>
                        <div class="d-flex align-items-center mt-5">
                            <button class="btn text-white  button-30 add-to-cart-btn" style="background: #da70d6"
                            data-id="<?php echo $data['petID']; ?>" data-pet-type="<?php echo $data['petType']; ?>"
                                        data-price="<?php echo $data['price']; ?>" data-breed="<?php echo $data['breed']; ?>"
                                        data-image="<?php echo $data['image']; ?>"
                            >Add to Cart</button>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class='mt-4 text-secondary'>
            <h3 class='text-gray'>Seller's Information</h3>
            <p class='mb-1'>Name: <?php echo htmlspecialchars($pet['sellerName']); ?></p>
            <p class='mb-1'>Contact No: <?php echo htmlspecialchars($pet['sellerPhone']); ?></p>
            <p class='mb-1'>Email: <?php echo htmlspecialchars($pet['sellerEmail']); ?></p>
        </div>

        <div class='mt-4 text-secondary'>
            <?php if (!empty($review)): ?>
                <h3 class='text-gray'>Buyer's Review</h3>
                <!-- Display the review -->
                <p><?php echo htmlspecialchars($review); ?></p>
            <?php endif; ?>

            <!-- Only show the form to the buyer if no review exists and they have bought the pet -->
            <?php if ($role === 'buyer' && $hasBoughtPet && empty($review)): ?>
                <h3 class='text-gray'>Leave a Review</h3>

                <form method="POST" action="">
                    <textarea name="review" required class='form-control' cols='2'></textarea>
                    <div class="d-flex align-items-center mt-3 d-flex justify-content-end">
                        <button type="submit" name='review-button' class="btn text-white button-30"
                            style="background: #da70d6">Submit</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div id="success-alert" class="alert alert-success align-items-center gap-2 fs-7 position-fixed font-thin border-0"
        role="alert" style="display: none; bottom:20px; right:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-circle-check">
            <circle cx="12" cy="12" r="10" />
            <path d="m9 12 2 2 4-4" />
        </svg>

        <span id="success-message">Pet added to cart successfully</span>
    </div>
    <div id="error-alert" class="alert alert-danger align-items-center gap-2 fs-7 position-fixed font-thin border-0"
        role="alert" style="display: none; bottom:20px; right:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-octagon-alert">
            <path d="M12 16h.01" />
            <path d="M12 8v4" />
            <path
                d="M15.312 2a2 2 0 0 1 1.414.586l4.688 4.688A2 2 0 0 1 22 8.688v6.624a2 2 0 0 1-.586 1.414l-4.688 4.688a2 2 0 0 1-1.414.586H8.688a2 2 0 0 1-1.414-.586l-4.688-4.688A2 2 0 0 1 2 15.312V8.688a2 2 0 0 1 .586-1.414l4.688-4.688A2 2 0 0 1 8.688 2z" />
        </svg>
        <span id="error-message">Pet is already in the cart!</span>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
         const cartButtons = document.querySelectorAll('.add-to-cart-btn');
         const cartBadge = document.getElementById('cart-badge');
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');
        const isLoggedIn = <?php echo !empty($id) ? 'true' : 'false'; ?>;

        // Get success and error messages from PHP (if available)
        const phpSuccessMessage = "<?php echo isset($_SESSION['success_message']) ? $_SESSION['success_message'] : ''; ?>";
        const phpErrorMessage = "<?php echo isset($_SESSION['error_message']) ? $_SESSION['error_message'] : ''; ?>";

        // Function to show and hide notifications
        function showNotification(type, message) {
            const alert = type === 'success' ? successAlert : errorAlert;
            const messageSpan = type === 'success' ? successMessage : errorMessage;

            // Set the message dynamically
            messageSpan.textContent = message;

            // Show the alert
            alert.style.display = 'flex';

            // Hide the alert after 3 seconds
            setTimeout(() => {
                alert.style.display = 'none';
            }, 3000);
        }

        // Show toast if PHP messages exist
        if (phpSuccessMessage) {
            showNotification('success', phpSuccessMessage);
            <?php unset($_SESSION['success_message']); ?> // Clear message after displaying it
        }

        if (phpErrorMessage) {
            showNotification('error', phpErrorMessage);
            <?php unset($_SESSION['error_message']); ?> // Clear message after displaying it
        }

         cartButtons.forEach(button => {
            button.addEventListener('click', function () {
                if (!isLoggedIn) {
                    // Redirect to login page if not logged in
                    window.location.href = 'login.php';
                    return;
                }

                const petId = this.getAttribute('data-id');
                const petType = this.getAttribute('data-pet-type');
                const price = this.getAttribute('data-price');
                const breed = this.getAttribute('data-breed');
                const image = this.getAttribute('data-image');

                const pet = {
                    id: petId,
                    type: petType,
                    price: price,
                    breed: breed,
                    image
                };

                // Get existing cart items from localStorage
                let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

                // Check if the pet is already in the cart
                const petExists = cart.find(item => item.id === petId);

                if (!petExists) {
                    // Add the new pet to the cart
                    cart.push(pet);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartCount();

                    // Show success notification
                    showNotification('success', "Pet added to cart successfully");
                } else {
                    // Show error notification
                    showNotification('error', "Pet is already in the cart!");
                }
            });
        });

        // Update cart count on page load
        function updateCartCount() {
            const cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
            cartBadge.textContent = cart.length; // Update badge count with the number of items
        }

        updateCartCount(); // Call it initially to load the cart count
    </script>
</body>

</html>