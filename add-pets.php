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
        $targetDir = "./uploads/";

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/index.css">

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

<style>
        .div-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

      
    </style>
</head>

<body style="background-color: rgb(245, 248, 250);">
    <?php require_once 'nav.php'; //Include Navigation bar ?>
    <div class="container mt-5 ">
        <div class="container text-secondary  mt-4 ">
            <h3 class='text-grayv1'>Add A Pet</h3>
            <!-- Add enctype="multipart/form-data" to enable file uploads -->
            <form action="" method="post" enctype="multipart/form-data" class='mt-4 '>
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="petType" class="form-control" id="floatingInputType"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px; max-width: 700px;"
                        placeholder="Type" required>
                    <label for="floatingInputType">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="description" class="form-control"
                        id="floatingInputDescription"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px; max-width: 700px;"
                        placeholder="Description" required>
                    <label for="floatingInputDescription">Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input required="true" min="0" step="0.01" type="number" name="price" class="form-control"
                        id="floatingInputPrice"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px; max-width: 700px;"
                        placeholder="Price" required>
                    <label for="floatingInputPrice">Price</label>
                </div>
                <div class="form-floating pt-0 mb-3">
                    <!-- Change this input to accept file uploads -->
                    <input type="file" name="image" class="form-control pt-3" id="floatingInputImage"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px; max-width: 700px;" accept="image/*"
                        required>
                    <!-- <label for="floatingInputImage">Upload Image</label> -->
                </div>
                <div class="form-floating mb-3">
                    <input required="true" type="text" name="breed" class="form-control" id="floatingInputBreed"
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px; max-width: 700px;"
                        placeholder="Breed" required>
                    <label for="floatingInputBreed">Breed</label>
                </div>
                <div class="mb-0">
                    <!-- <button class="button-30" role="button" >Add</button> -->
                    <button type="submit" name="add-btn" style="background: #da70d6"
                        class="btn text-white py-2 px-5 " style="border-radius: 8px;">Add</button>

                </div>
            </form>
        </div>
    </div>
    <?php require_once './footer.php'; //Include Foot ?>

    
</body>

</html>