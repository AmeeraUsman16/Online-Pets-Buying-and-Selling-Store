<?php
session_start();
require_once '../db.php';
if ($_SESSION['role'] !== 'admin') {
    header("Location: /pets");
    exit(); // Ensure the script stops here after redirection
}

// Get the filter from the URL parameters, default to 'all-time'
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all-time';

// Determine the date range for filtering
switch ($filter) {
    case 'today':
        $startDate = date('Y-m-d 00:00:00');
        $endDate = date('Y-m-d 23:59:59');
        break;
    case 'week':
        $startDate = date('Y-m-d 00:00:00', strtotime('monday this week'));
        $endDate = date('Y-m-d 23:59:59', strtotime('sunday this week'));
        break;
    case 'month':
        $startDate = date('Y-m-01 00:00:00');
        $endDate = date('Y-m-t 23:59:59');
        break;
    default:
        $startDate = null;
        $endDate = null;
        break;
}

// Add date range condition if applicable
$dateCondition = ($startDate && $endDate) ? " AND createdAt BETWEEN '$startDate' AND '$endDate'" : '';

// Fetch Total Pets (no date condition here as pets table doesn't have a relevant date column)
$petQuery = "SELECT COUNT(*) AS totalPets FROM tblpets";
$petResult = $db->query($petQuery);
$totalPets = $petResult->fetch_assoc()['totalPets'];

// Fetch Total Sellers (with role 'seller' from users table)
$sellerQuery = "SELECT COUNT(*) AS totalSellers FROM users WHERE role = 'seller'" . $dateCondition;
$sellerResult = $db->query($sellerQuery);
$totalSellers = $sellerResult->fetch_assoc()['totalSellers'];

// Fetch Total Buyers (with role 'buyer' from users table)
$buyerQuery = "SELECT COUNT(*) AS totalBuyers FROM users WHERE role = 'buyer'" . $dateCondition;
$buyerResult = $db->query($buyerQuery);
$totalBuyers = $buyerResult->fetch_assoc()['totalBuyers'];

// Fetch Total Revenue (with date condition on orders table)
$revenueQuery = "SELECT SUM(total_price) AS totalRevenue FROM orders WHERE 1=1" . $dateCondition;
$revenueResult = $db->query($revenueQuery);
$totalRevenue = $revenueResult->fetch_assoc()['totalRevenue'];
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/index.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

</head>

<body style="background-color: rgb(245, 248, 250);">
    <?php require_once '../nav.php' //Include Navigation bar ?>



    <div class="container mt-5">

        <div class=" d-flex justify-content-end gap-1">
            <label class="me-2 text-grayv1">Filter By</label>

            <a href="?filter=today">
                <input type="radio" class="btn-check" name="options-outlined1" id="today" autocomplete="off"
                    <?= (isset($_GET['filter']) && $_GET['filter'] === 'today') ? 'checked' : '' ?>>
                <label class="btn btn-outline-success" for="success-outlined1">Today</label>
            </a>

            <a href="?filter=week">
                <input type="radio" class="btn-check" name="options-outlined2" id="week" autocomplete="off"
                    <?= (isset($_GET['filter']) && $_GET['filter'] === 'week') ? 'checked' : '' ?>>
                <label class="btn btn-outline-success" for="success-outlined2">This Week</label>
            </a>

            <a href="?filter=month">
                <input type="radio" class="btn-check" name="options-outlined3" id="month" autocomplete="off"
                    <?= (isset($_GET['filter']) && $_GET['filter'] === 'month') ? 'checked' : '' ?>>
                <label class="btn btn-outline-success" for="success-outlined3">Month</label>
            </a>


            <a href="?filter=all-time">
                <input type="radio" class="btn-check" name="options-outlined4" id="reset" autocomplete="off"
                    <?= (isset($_GET['filter']) && $_GET['filter'] === 'all-time') ? 'checked' : '' ?>>
                <label class="btn btn-outline-success" for="success-outlined4">All Time</label>
            </a>
        </div>


        <h2 class="text-secondary">Dashboard</h2>

        <div class="row mt-5 rounded bg-light w-25 p-3">
            <div class="col-sm ">Total Revenue: <p class='fs-5 d-inline text-accent ps-1'> Rs. <?= $totalRevenue ?? 0 ?>
                </p>
            </div>
        </div>

        <div class="row mt-1 bg-light rounded w-75">
            <div class="col-sm-4 p-5">Total Pets: <p class='fs-4 d-inline text-accent ps-2'><?= $totalPets ?? 0 ?></p>
            </div>
            <div class="col-sm-4 border-top-0 border-bottom-0 border-start border-end p-5">Total Sellers:
                <p class='fs-4 d-inline text-accent ps-2'><?= $totalSellers ?? 0 ?></p>
            </div>
            <div class="col-sm-4 p-5">Total Buyers: <p class='fs-4 d-inline text-accent ps-2'> <?= $totalBuyers ?? 0 ?>
                </p>
            </div>
        </div>

    </div>

    <?php require_once '../footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#startDate", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#endDate", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>
</body>

</html>