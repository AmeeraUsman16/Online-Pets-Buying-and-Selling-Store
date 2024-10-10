<?php
session_start();
require_once 'db.php';
$uid = $_SESSION['userid'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/index.css">

    <style>
        /* Styling for the Proceed button */
        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FAF0E6;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            box-sizing: border-box;
            color: white;
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

        .div-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body>
    <?php require_once 'nav.php'; //Include Navigation bar ?>
    <div class="container mt-5" style="margin-bottom:70px">
        <h1 class="fw-bold text-grayv1 fs-2 text-center mt-5 mb-4">Order Details</h1>

        <div class="container mt-5 div-form">
            <form id="orderForm" action="" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="fullname" class="form-control" id="fullname"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;"
                        placeholder="Full Name" required>
                    <label for="fullname">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="address" class="form-control" id="address"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;"
                        placeholder="Address" required>
                    <label for="address">Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="postalcode" class="form-control" id="postalcode"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;"
                        placeholder="Postal Code" required>
                    <label for="postalcode">Postal Code</label>
                </div>

                <div class="form-floating mb-3">
                    <input required="true" type="tel" id="phone" name="phone" class="form-control"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;"
                        placeholder="Phone Number" required>
                    <label for="phone">03xx-xxxxxxx</label>
                </div>
                <div class="mb-0">
                    <button style="background: #FF6F61" class="button-30" id="proceedButton" type="button"
                        role="button">Proceed</button>
                </div>
            </form>
        </div>
    </div>

    <div id="error-alert" class="alert alert-danger align-items-center gap-2 position-fixed font-thin border-0"
        role="alert" style="display: none; bottom:20px; right:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-octagon-alert">
            <path d="M12 16h.01" />
            <path d="M12 8v4" />
            <path
                d="M15.312 2a2 2 0 0 1 1.414.586l4.688 4.688A2 2 0 0 1 22 8.688v6.624a2 2 0 0 1-.586 1.414l-4.688 4.688a2 2 0 0 1-1.414.586H8.688a2 2 0 0 1-1.414-.586l-4.688-4.688A2 2 0 0 1 2 15.312V8.688a2 2 0 0 1 .586-1.414l4.688-4.688A2 2 0 0 1 8.688 2z" />
        </svg> <span id="alert-text" class='fs-7'></span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>


    <!-- JavaScript to handle form submission and sessionStorage -->
    <script>
        document.getElementById('proceedButton').addEventListener('click', function () {
            // Get form values
            const fullname = document.getElementById('fullname').value;
            const address = document.getElementById('address').value;
            const postalcode = document.getElementById('postalcode').value;
            const phone = document.getElementById('phone').value;

            // Function to show the alert
            function showAlert(message) {
                document.getElementById('alert-text').innerText = message;
                document.getElementById('error-alert').style.display = 'flex';

                // Hide the alert after 3 seconds
                setTimeout(() => {
                    document.getElementById('error-alert').style.display = 'none';
                }, 3000);
            }

            // Validate form fields
            if (!fullname) {
                showAlert('Full Name is required!');
                return;
            }

            if (!address) {
                showAlert('Address is required!');
                return;
            }

            if (!postalcode) {
                showAlert('Postal Code is required!');
                return;
            }

            if (!phone) {
                showAlert('Phone number is required!');
                return;
            }

            // Store them in sessionStorage if all fields are valid
            sessionStorage.setItem('orderDetails', JSON.stringify({ fullname, address, postalcode, phone }));

            // Redirect to payment-method.php
            window.location.href = 'payment-method.php';
        });
    </script>

    <?php require_once '../footer.php'; //Include Footer ?>
</body>

</html>