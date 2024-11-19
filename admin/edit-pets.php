<?php
session_start();
require_once '../db.php';
$petID = $_GET['petID'];


if ($_SESSION['role'] !== 'admin') {
    header("Location: /pets");
    exit(); // Ensure the script stops here after redirection
}


// Check if the form has been submitted
if (isset($_POST['update-btn'])) {
    $petType = $_POST['petType'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $breed = $_POST['breed'];

    // Handle file upload if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "../uploads/" . $image);

        // Update query including image update
        $update = "UPDATE tblpets SET petType='$petType', description='$description', price='$price', breed='$breed', image='$image' WHERE petID='$petID'";
    } else {
        // Update query without changing the image
        $update = "UPDATE tblpets SET petType='$petType', description='$description', price='$price', breed='$breed' WHERE petID='$petID'";
    }

    // Run the update query
    $run = mysqli_query($db, $update);
    if ($run) {
        echo "<div class='alert alert-success mb-0 mt-3'>Pets Updated Successfully</div>";
    } else {
        echo "<div class='alert alert-danger mb-0 mt-3'>Error: " . mysqli_error($db) . "</div>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Pet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/index.css">

    <style>
        .div-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FAF0E6;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #4F000000 0 -3px 0 inset;
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
            box-shadow: #4F000000 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #4F000000 0 -3px 0 inset;
        }

        .button-30:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #4F000000 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-30:active {
            box-shadow: #4F000000 0 3px 7px inset;
            transform: translateY(2px);
        }
    </style>
</head>

<body style="background-color: rgb(245, 248, 250);">
    <?php require_once '../nav.php'; //Include Navigation bar ?>

    <div class="container mt-5">
        <?php
        // Fetch the pet details from the database
        $select = "SELECT * FROM tblpets WHERE petID='$petID'";
        $run = mysqli_query($db, $select);
        while ($data = mysqli_fetch_assoc($run)) { ?>
            <div class="container mt-5 div-form">
                <!-- Form for updating pet details -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" name="petType" value="<?php echo $data['petType'] ?>" class="form-control"
                            id="floatingInputUsername" placeholder="Pet Type" required
                            style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;">
                        <label for="floatingInputUsername">Pet Type</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="description" value="<?php echo $data['description'] ?>"
                            class="form-control" id="floatingInputDescription" placeholder="Description" required
                            style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;">
                        <label for="floatingInputDescription">Description</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="price" value="<?php echo $data['price'] ?>" class="form-control"
                            id="floatingInputPrice" placeholder="Price" required
                            style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;">
                        <label for="floatingInputPrice">Price</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="file" name="image" class="form-control pt-3" id="floatingInputImage"
                          style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;"
                            accept="image/*">

                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="breed" value="<?php echo $data['breed'] ?>" class="form-control"
                            id="floatingInputBreed" placeholder="Breed" required
                            style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;">
                        <label for="floatingInputBreed">Breed</label>
                    </div>

                    <div class="mb-0">
                        <button type="submit" name="update-btn" class="button-30 "
                        style="background: #da70d6;border-radius: 10px;">UPDATE</button>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>


    <?php require_once '../footer.php'; //Include Footer ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>