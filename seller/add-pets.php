<?php
session_start();
require_once 'db.php';
$uid=$_SESSION['userid'];
if (isset($_POST['add-btn'])) {
    $petType=$_POST['petType'];
    $description=$_POST['description'];
    $insert="INSERT INTO tblpets (fksellID,petType,description) 
    VALUES('$uid','$petType','$description')";
    $run=mysqli_query($db,$insert);
    if($run){
        echo "<div class='alert alert-success mb-0 mt-3'>Pets Added Successfully</div>";
    }else{
        echo "<div class='alert alert-danger mb-0 mt-3'>Something went wrong</div>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php  require_once 'nav.php' //Include Navigation bar?>
    <div class="container mt-5">
        <div class="container mt-5">
            <form action="" method="post">
                <div class="form-floating mb-3">
                    <input type="text" name="petType" class="form-control" id="floatingInputUsername" style="border: none; border-bottom: 1px solid #000; border-radius:0;width:700px;"
                        placeholder="Your Name" required>
                    <label for="floatingInputUsername">Type</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="description" class="form-control" id="floatingInput" style="border: none; border-bottom: 1px solid #000; border-radius:0;width:700px;"
                        placeholder="name@example.com" required>
                    <label for="floatingInput">Description</label>
                </div>
                <div class="mb-0">
                    <button type="submit" name="add-btn" class="btn btn-dark p-3 px-5" style="border-radius: 27px;">Add</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>