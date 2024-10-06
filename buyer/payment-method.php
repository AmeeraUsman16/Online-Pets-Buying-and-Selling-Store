<?php
// Initialize variables for storing form submission data
$name = $card_number = $expiry = $cvv = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input data
    $name = htmlspecialchars(trim($_POST['name']));
    $card_number = htmlspecialchars(trim($_POST['card_number']));
    $expiry = htmlspecialchars(trim($_POST['expiry']));
    $cvv = htmlspecialchars(trim($_POST['cvv']));

    // Basic validation
    if (empty($name) || empty($card_number) || empty($expiry) || empty($cvv)) {
        $error_message = "All fields are required.";
    } else {
        // Process payment logic here (e.g., connect to payment gateway)
        // In a real application, this is where you'd call the payment processor API.

        // For demonstration, just display the data
        echo "<h1>Payment Information</h1>";
        echo "<p>Name: $name</p>";
        echo "<p>Card Number: $card_number</p>";
        echo "<p>Expiry Date: $expiry</p>";
        echo "<p>CVV: $cvv</p>";

        // In a production environment, do not display sensitive information like the CVV
        exit; // Stop further execution
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin: 30px auto;
        }

        .container .card {
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            background: #fff;
            border-radius: 0px;
        }

        body {
            background: #eee;
        }

        .btn.btn-primary {
            background-color: #ddd;
            color: black;
            box-shadow: none;
            border: none;
            font-size: 20px;
            width: 100%;
            height: 100%;
        }

        .btn.btn-primary:focus {
            box-shadow: none;
        }

        .container .card .img-box {
            width: 80px;
            height: 50px;
        }

        .container .card img {
            width: 100%;
            object-fit: fill;
        }

        .container .card .number {
            font-size: 24px;
        }

        .container .card-body .btn.btn-primary .fab.fa-cc-paypal {
            font-size: 32px;
            color: #3333f7;
        }

        .fab.fa-cc-amex {
            color: #1c6acf;
            font-size: 32px;
        }

        .fab.fa-cc-mastercard {
            font-size: 32px;
            color: red;
        }

        .fab.fa-cc-discover {
            font-size: 32px;
            color: orange;
        }

        .c-green {
            color: green;
        }

        .btn.btn-primary.payment {
            background-color: #1c6acf;
            color: white;
            border-radius: 0px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 24px;
        }

        .form__div {
            height: 50px;
            position: relative;
            margin-bottom: 24px;
        }

        .form-control {
            width: 100%;
            height: 45px;
            font-size: 14px;
            border: 1px solid #DADCE0;
            border-radius: 0;
            outline: none;
            padding: 2px;
            background: none;
            z-index: 1;
            box-shadow: none;
        }

        .form__label {
            position: absolute;
            left: 16px;
            top: 10px;
            background-color: #fff;
            color: #80868B;
            font-size: 16px;
            transition: .3s;
            text-transform: uppercase;
        }

        .form-control:focus+.form__label {
            top: -8px;
            left: 12px;
            color: #1A73E8;
            font-size: 12px;
            font-weight: 500;
            z-index: 10;
        }

        .form-control:not(:placeholder-shown).form-control:not(:focus)+.form__label {
            top: -8px;
            left: 12px;
            font-size: 12px;
            font-weight: 500;
            z-index: 10;
        }

        .form-control:focus {
            border: 1.5px solid #1A73E8;
            box-shadow: none;
        }

        .body-style{
            max-width: 700px;
           margin: auto;
      
        }
    </style>
</head>
<body>
<?php require_once 'nav.php'; //Include Navigation bar ?>
    <div class="body-style">
    <div class="container">
        <div class="row">
            <!-- Credit Cards Section -->
            <div class="col-lg-4 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-box">
                        <img src="https://www.freepnglogos.com/uploads/visa-logo-download-png-21.png" alt="">
                    </div>
                    <div class="number">
                        <label class="fw-bold" for="">**** **** **** 1060</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                        <small><span class="fw-bold">Name:</span><span>Kumar</span></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-box">
                        <img src="https://www.freepnglogos.com/uploads/mastercard-png/file-mastercard-logo-svg-wikimedia-commons-4.png" alt="">
                    </div>
                    <div class="number">
                        <label class="fw-bold">**** **** **** 1060</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                        <small><span class="fw-bold">Name:</span><span>Kumar</span></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-lg-0 mb-3">
                <div class="card p-3">
                    <div class="img-box">
                        <img src="https://www.freepnglogos.com/uploads/discover-png-logo/credit-cards-discover-png-logo-4.png" alt="">
                    </div>
                    <div class="number">
                        <label class="fw-bold">**** **** **** 1060</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                        <small><span class="fw-bold">Name:</span><span>Kumar</span></small>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Payment Methods</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="true" aria-controls="collapseExample1">
                                <span class="fw-bold">PayPal</span>
                                <span class="fab fa-cc-paypal"></span>
                            </a>
                        </p>
                        <div class="collapse p-3 pt-0" id="collapseExample1">
                            <div class="row">
                                <div class="col-8">
                                    <p class="h4 mb-0">Summary</p>
                                    <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of product</span></p>
                                    <p class="mb-0"><span class="fw-bold">Price:</span><span class="c-green">:$452.90</span></p>
                                </div>
                                <div class="col-4">
                                    <img class="img-box" src="https://www.freepnglogos.com/uploads/credit-card-logo-png-4.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="" method="post">
                    <div class="form__div">
                        <input type="text" name="name" class="form-control" placeholder=" " required>
                        <label class="form__label">Name on Card</label>
                    </div>
                    <div class="form__div">
                        <input type="text" name="card_number" class="form-control" placeholder=" " required>
                        <label class="form__label">Card Number</label>
                    </div>
                    <div class="form__div">
                        <input type="text" name="expiry" class="form-control" placeholder=" " required>
                        <label class="form__label">Expiry Date (MM/YY)</label>
                    </div>
                    <div class="form__div">
                        <input type="text" name="cvv" class="form-control" placeholder=" " required>
                        <label class="form__label">CVV</label>
                    </div>
                    <button type="submit" class="btn btn-primary payment">Pay Now</button>
                </form>
                <?php
                // Display any error messages
                if (!empty($error_message)) {
                    echo "<div class='alert alert-danger mt-3'>$error_message</div>";
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <?php require_once 'footer.php'; //Include Footer ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>



  
</body>
</html>
