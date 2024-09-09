<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                    <?php
                        $select="SELECT*FROM users WHERE role='buyer'";
                        $run=mysqli_query($db,$select);
                        $count=0;
                        while ($data=mysqli_fetch_assoc($run)) {
                        $count++;
                    ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $count ?></th>
                        <td><?php echo $data['name'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td><?php echo $data['number'] ?></td>
                        <td>
                            <a  href="edit-user.php?id=<?php echo $data['uid']; ?>">
                            <i class="fas fa-pen" style="font-size:25px;color:#0597a0;margin-right:20px;"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>