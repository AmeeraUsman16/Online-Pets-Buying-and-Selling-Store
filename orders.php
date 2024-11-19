<?php
session_start();
require_once 'db.php'; // Include the db configuration for connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['markCompleted'])) {
  $orderId = intval($_POST['orderId']); // Sanitize input

  // Update the status in the database
  $query = "UPDATE orders SET status = 'Completed' WHERE id = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param('i', $orderId);

  if ($stmt->execute()) {
    $_SESSION['success'] = "Order #$orderId has been marked as completed.";
  } else {
    $_SESSION['error'] = "Failed to update the order status.";
  }

  $stmt->close();
  // Redirect back to the same page to reflect changes and avoid form resubmission
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

$id = $_SESSION['userid'];

// Fetch orders and associated pets for the logged-in seller
$query = "
    SELECT 
        o.id AS orderId, 
        o.total_price AS totalAmount, 
        o.customer_name AS customerName, 
     DATE_FORMAT(o.createdAt, '%M %d, %Y %h:%i %p') AS createdAt,
        o.customer_phone AS phone, 
        o.address,  o.status,
        oi.name AS petName, 
        oi.price, 
        oi.breed, 
        oi.image 
    FROM orders AS o
    INNER JOIN order_items AS oi ON o.id = oi.order_id
    INNER JOIN tblpets AS p ON oi.petID = p.petID
    WHERE p.sellerId = ?
    ORDER BY o.id DESC
";

$stmt = $db->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Prepare a structure to organize orders and their pets
$orders = [];
while ($row = $result->fetch_assoc()) {
  $orders[$row['orderId']]['details'] = [
    'totalAmount' => $row['totalAmount'],
    'customerName' => $row['customerName'],
    'phone' => $row['phone'],
    'address' => $row['address'],
    'createdAt' => $row['createdAt'],
    'status' => $row['status']
  ];
  $orders[$row['orderId']]['pets'][] = [
    'petName' => $row['petName'],
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
    <h3 class="text-gray container">Orders</h3>

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
                <h3 class="text-gray fs-6">Payment Method: <span style="color: #f27bb8;">Card</span></h3>
                <h3 class="text-gray fs-6">Order Date: <span
                    style="color: #f27bb8;"><?php echo $order['details']['createdAt']; ?></span></h3>
                <form method="POST" action="">
                  <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
                  <button
                    class='btn <?php echo $order['details']['status'] === "Completed" ? "btn-success" : "btn-primary"; ?> fs-7'
                    <?php echo $order['details']['status'] === "Completed" ? "disabled" : ""; ?> name="markCompleted">
                    <?php echo $order['details']['status'] === "Completed" ? "Completed" : "Mark As Completed"; ?>
                  </button>
                </form>
              </div>

              <!-- Customer Information -->
              <div class="pl-2">
                <h2 class="text-gray fs-6">Customer's Name: <span
                    style="color: #f27bb8;"><?php echo $order['details']['customerName']; ?></span></h2>
                <h2 class="text-gray fs-6">Phone: <span
                    style="color: #f27bb8;"><?php echo $order['details']['phone']; ?></span></h2>
                <h2 class="text-gray fs-6">Address: <span
                    style="color: #f27bb8;"><?php echo $order['details']['address']; ?></span></h2>
              </div>
            </div>

            <!-- Pets Section -->
            <div class="container pets-wrapper mt-4">
              <h2 class="text-gray fs-4">Pets:</h2>
              <div class="row g-3">
                <?php foreach ($order['pets'] as $pet) { ?>
                  <div class="col-12 col-md-6">
                    <div class="d-flex pet-item bg-grayv1 p-1 rounded">
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
                    </div>
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