<?php
session_start();
$id = $_SESSION['userid'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VIEW</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/index.css">

    <style>
        .pet-card-image {
            width: 100%;
            min-width: 120px;
            height: 90px;
            object-fit: cover;
        }

        .container {
            display: flex;
            /* Use flexbox to align items horizontally */
            justify-content: space-between;
            /* Optionally space them out */
            padding: 10px;
            /* background-color: blue; */
            max-width: 900px;

        }

        .pets-wrapper {
            max-width: 700px;
        }


        .box1,
        .box2 {
            flex: 1;
            /* Makes both boxes equal width */
            padding: 20px;
            margin: 10px;
            /* background-color: #f2f2f2; Optional styling for the boxes */
            /* border: 1px solid #ccc;  Optional border */

        }

        .box2 {

            padding: 20px;
            margin: 10px;
            /* background-color: #f2f2f2; Optional styling for the boxes */
            /* border: 1px solid #ccc;  Optional border */


        }

        .icon-box {
            display: flex;
            justify-content: space-between;
        }

        .icon-box2 {
            display: flex;
            /* Use flexbox to align items horizontally */
            justify-content: space-between;
            /* background-color: #f2f2f2; Optional styling for the boxes */
            /* border: 1px solid black;  Optional border */
            max-width: 100px;
            margin-left: 0px;
            /* border-radius: 5px; */
            /* background-color: pink; */
        }
    </style>

</head>

<body style="background-color: rgb(245, 248, 250);">
    <?php
    require_once './nav.php';
    require_once './db.php';
    ?>

    <div class="mt-4">
        <?php
        $select = "SELECT*FROM tblpets WHERE sellerId='$id'";
        $run = mysqli_query($db, $select);
        $count = 0;
        while ($data = mysqli_fetch_assoc($run)) {
            $count++;
            ?>


            <div class="container pets-wrapper">
                <div class='d-flex pet-item bg-grayv1 p-1 rounded w-100'>
                    <div style="max-width:200px;max-height:200px" class="p-2">
                        <img class="rounded card-img-top pet-card-image p-0" src="./uploads/<?php echo $data['image']; ?>"
                            alt="Pets_image">
                    </div>
                    <div class="pl-5 p-2 d-flex justify-content-between w-100">

                        <div>
                            <p class="card-title fs-5 text-gray"><?php echo $data['petType']; ?></p>
                            <p class="card-title text-gray"><?php echo $data['price']; ?></p>
                            <p class="card-text text-accent fs-7"><?php echo $data['breed']; ?></p>
                            <!-- <p class="card-text"><?php echo $data['description']; ?></p> -->
                        </div>

                        <div class="icon-box pe-3 pt-3">
                            <a href="edit-pets.php?petID=<?php echo $data['petID']; ?>">
                                <i class="fas fa-pen"
                                    style="font-size:16px;color:grey;margin-right:16px;align-items: center;"></i></a>

                            <div class="icon-box2">
                                <a href="view-pets.php?delete=<?php echo $data['petID']; ?>">
                                    <i class="fas fa-trash" style="font-size:16px;color:grey"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        <?php } ?>
        <!-- </table> -->
        <?php

        if (isset($_GET['delete'])) {
            $delete = $_GET['delete'];
            $dellQuerry = "DELETE FROM tblpets WHERE petID='$delete'";
            $run = mysqli_query($db, $dellQuerry);
            if ($run) {
                echo "<div class='alert alert-danger mb-0 mt-3' style='border-radius: 27px;>DELETE</div>";
            } else {
                echo "<div class='alert alert-danger mb-0 mt-3' style='border-radius: 27px;'>Something went wrong</div>";
            }
        } ?>
    </div>
    <?php require_once './footer.php'; //Include Foot ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>