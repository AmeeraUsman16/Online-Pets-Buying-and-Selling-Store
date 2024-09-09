<?php
session_start();
$id=$_SESSION['userid'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VIEW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php  
        require_once 'nav.php';
        require_once 'db.php';   
    ?>
    <div class="container mt-5">
        <div class="container mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pets Type</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <?php
                    $select="SELECT*FROM tblpets";
                    $run=mysqli_query($db,$select);
                    $count=0;
                    while ($data=mysqli_fetch_assoc($run)) {
                    $count++;
                ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $count ?></th>
                        <td><?php echo $data['petType'] ?></td>
                        <td><?php echo $data['description'] ?></td>
                    </tr>
                </tbody>
                <?php  } ?>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>