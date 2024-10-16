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
    echo "<div class='alert alert-danger mb-0 mt-3'>Pet not found!</div>";
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

<body>

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
                            <button class="btn text-white  button-30" style="background: #FF6F61">Add to Cart</button>
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

        <?php if ($role === 'buyer' && $hasBoughtPet): ?>
            <div class='mt-4 text-secondary'>
                <h3 class='text-gray'>Review</h3>
                <textarea class='form-control' cols='2'></textarea>
                <div class="d-flex align-items-center mt-3 d-flex justify-content-end">
                    <button class="btn text-white button-30" style="background: #FF6F61">Submit</button>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>