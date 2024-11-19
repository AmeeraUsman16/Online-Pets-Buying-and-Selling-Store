<?php
session_start();
require_once 'db.php'; // Include the db configuration for connection

// Get the logged-in user's ID
$userId = $_SESSION['userid'];

// Fetch orders and associated pets for the logged-in user
$query = "
    SELECT 
        o.id AS orderId, 
        o.total_price AS totalAmount, 
        DATE_FORMAT(o.createdAt, '%M %d, %Y %h:%i %p') AS createdAt,
        o.status,
        oi.name AS petName, 
        oi.petID as id, 
        oi.price, 
        oi.breed, 
        oi.image 
    FROM orders AS o
    INNER JOIN order_items AS oi ON o.id = oi.order_id
    WHERE o.customer_id = ?
    ORDER BY o.id DESC
";

$stmt = $db->prepare($query);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

// Prepare a structure to organize orders and their pets
$orders = [];
while ($row = $result->fetch_assoc()) {
  $orders[$row['orderId']]['details'] = [
    'totalAmount' => $row['totalAmount'],
    'createdAt' => $row['createdAt'],
    'status' => $row['status']
  ];
  $orders[$row['orderId']]['pets'][] = [
    'petName' => $row['petName'],
    'id' => $row['id'],
    'price' => $row['price'],
    'image' => $row['image'],
    'breed' => $row['breed']
  ];
}

$stmt->close();
$db->close();
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
  <title>Orders</title>

  <style>
    .div-styl {
      background-color: red;
      margin-top: 100px;
    }
  </style>
</head>


<body style="background-color: rgb(245, 248, 250);">

  <?php include 'nav.php'; ?>

  <div class="mt-5">
    <h3 class="text-gray container">My Orders</h3>

    <div class="container">
      <?php if (!empty($orders)) { ?>
        <?php foreach ($orders as $orderId => $order) { ?>
          <div class="border order-container p-3 rounded mb-4">
            <div class="container">
              <!-- Order Information -->
              <div class="text-end">
                <h3 class="text-gray">Order ID: #<span style="color: #f27bb8;"><?php echo $orderId; ?></span></h3>
                <h3 class="text-gray fs-6">Total Amount: <span
                    style="color: #f27bb8;"><?php echo $order['details']['totalAmount']; ?></span></h3>
                <h3 class="text-gray fs-6">Order Date: <span
                    style="color: #f27bb8;"><?php echo $order['details']['createdAt']; ?></span></h3>
                <h3 class="text-gray fs-6">Status: <span style="color: <?php echo $order['details']['status'] === 'Completed' ? 'green' : '#dccd79'; ?>;"><?php echo $order['details']['status']; ?></span></h3>
              </div>
            </div>

            <!-- Pets Section -->
            <div class="container pets-wrapper mt-4">
              <h2 class="text-gray fs-4">Pets:</h2>
              <div class="row g-3">
                <?php foreach ($order['pets'] as $pet) { ?>
                  <div class="col-12 col-md-6">
                    <a href='/pets/pet-details.php?petID=<?php echo $pet['id']; ?>' class="d-flex pet-item bg-grayv1 p-1 rounded underline-0" style='text-decoration: none'>
                      <div style="max-width:200px; max-height:200px" class="p-2">
                        <img class="rounded card-img-top pet-card-image p-0" src="./uploads/<?php echo $pet['image']; ?>"
                          alt="Pet Image">
                      </div>
                      <div class="pl-5 p-2 d-flex justify-content-between w-100">
                        <div>
                          <p class="card-title fs-5 text-gray"><?php echo $pet['petName']; ?></p>
                          <p class="card-title text-gray">Price: <?php echo $pet['price']; ?></p>
                          <p class="card-text text-accent fs-7"><?php echo $pet['breed']; ?></p>

                        </div>
                      </div>
                    </a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } else { ?>
        <p class="text-center text-danger">No orders found!</p>
      <?php } ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

</body>

</html>