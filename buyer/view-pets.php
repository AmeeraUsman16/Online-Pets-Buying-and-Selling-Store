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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .pet-card-image {
            width: 100%;
            max-width: 300px;
            height: 250px;
            object-fit: cover;
        }

        @media screen and (max-width: 580px) {
            .pet-card-image {
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once 'nav.php';
    require_once 'db.php';
    ?>

    <div class="container">
        <div class="row">
            <?php
            $select = "SELECT*FROM tblpets";
            $run = mysqli_query($db, $select);
            $count = 0;
            while ($data = mysqli_fetch_assoc($run)) {
                $count++;
                ?>



                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4"> <!-- Change the column size as needed -->
                    <div class="card">
                        <img class="card-img-top pet-card-image" src="../uploads/<?php echo $data['image']; ?>"
                            alt="Pets_image">
                        <div class="card-body">
                            <div class="d-flex justify-content-between  align-items-center"> <!-- Flex container -->
                                <strong class="card-title"><?php echo $data['petType']; ?></strong>
                                <strong class="card-title"><?php echo $data['price']; ?></strong>
                            </div>
                            <p class="card-text"><?php echo $data['breed']; ?></p>
                            <!-- <p class="card-text"><?php echo $data['description']; ?></p> -->
                           
                            <a href="cart-pets.php" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>

                </div>

            <?php } ?>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>