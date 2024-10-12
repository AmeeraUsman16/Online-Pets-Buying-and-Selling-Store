<?php
session_start();
require_once 'db.php';
$petID = $_GET['petID'];

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
        move_uploaded_file($image_tmp, "./uploads/" . $image);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <?php require_once 'nav.php'; //Include Navigation bar ?>

    <div class="container mt-5">
        <?php
        // Fetch the pet details from the database
        $select = "SELECT * FROM tblpets WHERE petID='$petID'";
        $run = mysqli_query($db, $select);
        while ($data = mysqli_fetch_assoc($run)) { ?>
            <div class="container mt-5">
                <!-- Form for updating pet details -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" name="petType" value="<?php echo $data['petType'] ?>" class="form-control"
                            id="floatingInputUsername" placeholder="Pet Type" required
                            style="border: none; border-bottom: 1px solid #000; border-radius:0; width:700px;">
                        <label for="floatingInputUsername">Pet Type</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="description" value="<?php echo $data['description'] ?>"
                            class="form-control" id="floatingInputDescription" placeholder="Description" required
                            style="border: none; border-bottom: 1px solid #000; border-radius:0; width:700px;">
                        <label for="floatingInputDescription">Description</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="price" value="<?php echo $data['price'] ?>" class="form-control"
                            id="floatingInputPrice" placeholder="Price" required
                            style="border: none; border-bottom: 1px solid #000; border-radius:0; width:700px;">
                        <label for="floatingInputPrice">Price</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="file" name="image" class="form-control pt-3" id="floatingInputImage"
                            style="border: none; border-bottom: 1px solid #000; border-radius:0; width:700px;"
                            accept="image/*">

                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="breed" value="<?php echo $data['breed'] ?>" class="form-control"
                            id="floatingInputBreed" placeholder="Breed" required
                            style="border: none; border-bottom: 1px solid #000; border-radius:0; width:700px;">
                        <label for="floatingInputBreed">Breed</label>
                    </div>

                    <div class="mb-0">
                        <button type="submit" name="update-btn" class="btn btn-dark p-3 px-5"
                            style="border-radius: 27px;">UPDATE</button>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>