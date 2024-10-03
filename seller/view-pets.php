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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <style>
    .container {
        display: flex;          /* Use flexbox to align items horizontally */
        justify-content: space-between; /* Optionally space them out */
        border-bottom: 2px solid #D8D8D8 ;
        padding: 10px;
        /* background-color: blue; */
        max-width: 900px;
        
    }

    .box1, .box2 {
        flex: 1;                /* Makes both boxes equal width */
        padding: 20px;
        margin: 10px;
        /* background-color: #f2f2f2; Optional styling for the boxes */
        /* border: 1px solid #ccc;  Optional border */

    }

    .box2{
        
        padding: 20px;
        margin: 10px;
        /* background-color: #f2f2f2; Optional styling for the boxes */
        /* border: 1px solid #ccc;  Optional border */
    
    
    }

    .icon-box{
        display: flex;          /* Use flexbox to align items horizontally */
        justify-content: space-between;
        /* background-color: #f2f2f2; Optional styling for the boxes */
        /* border: 1px solid black;  Optional border */
        max-width:40px;
    margin-left: 550px;
    margin-top: -55px;
    /* margin-right: 100px;
     */
     /* background-color: red; */
    }

    .icon-box2{
        display: flex;          /* Use flexbox to align items horizontally */
        justify-content: space-between;
        /* background-color: #f2f2f2; Optional styling for the boxes */
        /* border: 1px solid black;  Optional border */
        max-width:100px;
        margin-left:0px;
        /* border-radius: 5px; */
    /* background-color: pink; */
    }


        </style>

    </head>

    <body>
        <?php
        require_once 'nav.php';
        require_once 'db.php';
        ?>
        <!-- <div class="container mt-5">
            <div class="container mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pets Type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead> -->
        <?php
        $select = "SELECT*FROM tblpets WHERE sellerId='$id'";
        $run = mysqli_query($db, $select);
        $count = 0;
        while ($data = mysqli_fetch_assoc($run)) {
            $count++;
            ?>
            <!-- <tbody>
                            <tr>
                                <th scope="row"><?php echo $count ?></th>
                                <td><?php echo $data['petType'] ?></td>
                                <td><?php echo $data['description'] ?></td>
                                <td>

                                    <a href="edit-pets.php?petID=<?php echo $data['petID']; ?>">
                                        <i class="fas fa-pen" style="font-size:25px;color:#0597a0;margin-right:20px;"></i></a>
                                    <a href="view-pets.php?delete=<?php echo $data['petID']; ?>">
                                        <i class="fas fa-trash" style="font-size:25px;color:#0597a0"></i></a>
                                </td>
                            </tr>
                        </tbody> -->

            <div class="container">
                <div style="max-width:200px;max-height:200px" class="box1">
                    <img class="card-img-top pet-card-image" style="width:200px;height:200px;margin-top:-20px;margin-left:-20px" src="../uploads/<?php echo $data['image']; ?>" alt="Pets_image">
                </div>
                <div class="box2">

                    <strong class="card-title"><?php echo $data['petType']; ?></strong>
                    <strong class="card-title"><?php echo $data['price']; ?></strong>
                    <p class="card-text"><?php echo $data['breed']; ?></p>
                    <!-- <p class="card-text"><?php echo $data['description']; ?></p> -->
                    
                    <div class="icon-box">
                        
                        <a href="edit-pets.php?petID=<?php echo $data['petID']; ?>">
                        <i class="fas fa-pen" style="font-size:30px;color:grey;margin-right:20px;align-items: center;"></i></a>

                        <div class="icon-box2">
                            <a href="view-pets.php?delete=<?php echo $data['petID']; ?>">
                                <i class="fas fa-trash" style="font-size:30px;color:grey"></i></a>

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
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
    </body>

    </html>