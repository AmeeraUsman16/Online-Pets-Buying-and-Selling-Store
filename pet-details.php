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
    </head>
    <body>
    <?php
    require_once 'nav.php';
    require_once 'db.php';
    ?>

<?php
            $select = "SELECT*FROM tblpets";
            $run = mysqli_query($db, $select);
            $count = 0;
            while ($data = mysqli_fetch_assoc($run)) {
                $count++;
                ?>


<h1>hello</h1>







<?php } ?>



<?php require_once 'footer.php'; //Include Footer ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>