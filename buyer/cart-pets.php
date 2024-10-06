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


    <style>
        .pet-img {
            max-width: 200px;
            border-radius: 10px;
            max-height: 150px;
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
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
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
            transition: box-shadow .15s, transform .15s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            will-change: box-shadow, transform;
            font-size: 18px;
            max-width: 400px;
        }

        .button-30:focus {
            box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        }

        .button-30:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-30:active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php require_once 'nav.php'; ?>

    <h1 class="heading-style text-secondary detail">Your Cart</h1>
    <div class="container" style="max-width:900px;margin-bottom:80px">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-secondary fs-4 detail">Pet</th>
                    <th scope="col" class="text-secondary fs-4 detail">Detail</th>
                    <th scope="col" class="text-secondary fs-4 detail">Total</th>

                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch pets added by the user
                $select = "SELECT * FROM tblpets WHERE sellerId='$id'";
                $run = mysqli_query($db, $select);

                if (mysqli_num_rows($run) > 0) { // Check if there are results
                    while ($data = mysqli_fetch_assoc($run)) {
                        ?>
                        <tr>
                            <td><img class="card-img-top pet-img"
                                    src="../uploads/<?php echo htmlspecialchars($data['image']); ?>" alt="Pets_image"></td>
                            <td class="detail">
                                <span class="fs-5 text-secondary"><?php echo htmlspecialchars($data['petType']); ?></span><br>
                                <span class="text-secondary"><?php echo htmlspecialchars($data['description']); ?></span><br>
                                <span class="text-danger"
                                    style="font-size:0.9em;"><?php echo htmlspecialchars($data['breed']); ?></span>
                            </td>
                            <td class="text-secondary detail"><?php echo htmlspecialchars($data['price']); ?></td>
                            <td>
                                <a href="remove_from_cart-pets.php?delete=<?php echo $data['petID']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this pet?');">
                                    <!-- <i class="fas fa-trash" style="font-size:16px;color:grey"></i> -->
                                    <i class="material-icons" style="font-size:25px;color:grey;margin-left:20px;">delete</i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    echo '<tr><td colspan="4" class="text-center">No pets in your cart.</td></tr>'; // Message when no pets
                }
                ?>
            </tbody>
        </table>
        <div style="max-width:280px;max-height:260px;margin-left:650px">
            <p class="text-secondary detail ">Subtotal: </p>
            <p style="font-size: 12px;" class="text-secondary ">Taxes and shipping calculated at checkout</p>
            <button class="button-30" role="button" style="margin-left: 100px;" onclick="window.location.href='order-details.php';">
    Checkout
</button>



        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


        <?php require_once 'footer.php'; //Include Footer ?>
</body>

</html>