<?php
session_start();
require_once 'db.php';
$id=$_GET['petID'];

if (isset($_POST['update-btn'])) {
    $petType=$_POST['petType'];
    $description=$_POST['description'];
    $update="UPDATE tblpets SET petType='$petType', description='$description'
    WHERE petID='$id'";
    $run=mysqli_query($db,$update);
    if($run){
        echo "<div class='alert alert-success mb-0 mt-3'>Pets Updatte Successfully</div>";
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
        <?php
        $select="SELECT*FROM tblpets WHERE petID='$id'";
        $run=mysqli_query($db,$select);
        while ($data=mysqli_fetch_assoc($run)) { ?>
        <div class="container mt-5">
            <form action="" method="post">
                <div class="form-floating mb-3">
                    <input type="text" name="petType"  value="<?php echo $data['petType'] ?>"  class="form-control" id="floatingInputUsername"
                        placeholder="Your Name" required style="border: none; border-bottom: 1px solid #000; border-radius:0;width:700px;" >
                    <label for="floatingInputUsername">Your name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="description" value="<?php echo $data['description'] ?>" class="form-control" id="floatingInput"
                        placeholder="name@example.com" required style="border: none; border-bottom: 1px solid #000; border-radius:0;width:700px;" >
                    <label for="floatingInput">Description</label>
                </div>
                <div class="mb-0">
                    <button type="submit" name="update-btn" class="btn btn-dark p-3 px-5" style="border-radius: 27px;">UPDATE</button>
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