<?php
session_start();
require_once 'db.php';
$uid = $_SESSION['userid'];

if (isset($_POST['add-btn'])) {
    $petType = $_POST['petType'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $breed = $_POST['breed'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Define the directory to store the uploaded files
        $targetDir = "../uploads/";

        // Get the file extension
        $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        // Create a unique name for the uploaded file
        $fileName = uniqid() . "." . $fileExt;

        // Set the full file path
        $targetFile = $targetDir . $fileName;

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // File uploaded successfully, insert record into the database
            $insert = "INSERT INTO tblpets (sellerId, petType, description, price, image, breed) 
                       VALUES ('$uid', '$petType', '$description', '$price', '$fileName', '$breed')";

            $run = mysqli_query($db, $insert);
            if ($run) {
                echo "<div class='alert alert-success mb-0 mt-3'>Pet Added Successfully</div>";
            } else {
                echo "<div class='alert alert-danger mb-0 mt-3'>Something went wrong</div>";
            }
        } else {
            echo "<div class='alert alert-danger mb-0 mt-3'>Error uploading file</div>";
        }
    } else {
        echo "<div class='alert alert-danger mb-0 mt-3'>Please upload a valid image</div>";
    }
}
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
    <?php require_once 'nav.php'; //Include Navigation bar ?>
    <div class="container mt-5" style="margin-bottom:150px">
        <div class="container mt-5">
            <!-- Add enctype="multipart/form-data" to enable file uploads -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="petType" class="form-control" id="floatingInputType"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;"
                        placeholder="Full Name" required>
                    <label for="floatingInputType">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="description" class="form-control"
                        id="floatingInputDescription"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;"
                        placeholder="Address" required>
                    <label for="floatingInputDescription">Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="breed" class="form-control" id="floatingInputBreed"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;"
                        placeholder="Breed" required>
                    <label for="floatingInputBreed">Postcode</label>
                </div>
                
                <div class="form-floating mb-3">
                    <input required="true" type="tel" id="phone" name="phone"class="form-control" id="floatingInputBreed"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;" 
                        placeholder="Phone NUmber" required>
                    <label for="floatingInputBreed">03xx-xxxxxxx</label>
                </div>
                <div class="mb-0">
                    <button class="button-30" role="button" onclick="window.location.href='payment-method.php';">Proceed</button>
                </div>
            </form>
        </div>
    </div>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

          <!-- Footer -->
    <footer class="text-center " style="background-color:#FAF0E6">
        <!-- Grid container -->
        <div class="container">
            <!-- Section: Links -->
            <section class="mt-5">
                <!-- Grid row-->
                <div class="row text-center d-flex justify-content-center pt-5">
                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class='text-gray text-decoration-none'>About us</a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class='text-gray text-decoration-none'>Products</a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class='text-gray text-decoration-none'>Awards</a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class='text-gray text-decoration-none'>Help</a>
                        </h6>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <h6 class="text-uppercase font-weight-bold">
                            <a href="#!" class='text-gray text-decoration-none'>Contact</a>
                        </h6>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row-->
            </section>
            <!-- Section: Links -->

            <hr class="my-5" />

            <!-- Section: Text -->
            <section class="mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <p>
                            Pet's Heaven – Your Trusted Destination for Buying and Selling Pets
                            Find your perfect pet or loving home with ease. Pet's Heaven offers a wide range of pets,
                            from dogs and
                            cats to birds and more. Whether you're adopting or listing a pet, we ensure secure
                            transactions and a
                            community of responsible pet owners. Join us today and give a pet a loving home!
                        </p>
                    </div>
                </div>
            </section>
            <!-- Section: Text -->

            <!-- Section: Social -->
            <section class="text-center mb-5">
                <a href="" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-github"></i>
                </a>
            </section>
            <!-- Section: Social -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-white" href="#">Pet's Heaven</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>