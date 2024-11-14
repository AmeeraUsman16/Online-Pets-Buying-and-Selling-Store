<?php
session_start();
require_once 'db.php';
$id=$_SESSION['userid'];

if (isset($_POST['update-btn'])) {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $update="UPDATE users SET name='$name', email='$email',number='$number'
    WHERE uid='$id'";
    $run=mysqli_query($db,$update);
    if($run){
        echo "<div class='alert alert-success mb-0 mt-3'>Account has been Update</div>";
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
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>
        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FAF0E6;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #4F000000 0 -3px 0 inset;
            box-sizing: border-box;
            color: #36395A;
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

        .div-form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 100px
        }
    </style>
</head>

<body style="background-color: rgb(245, 248, 250);">
    <?php  require_once 'nav.php' //Include Navigation bar?>
    

    <div class="container mt-5">
        <div class="container mt-5 div-form">
          <?php
          $select="SELECT*FROM users WHERE uid='$id'";
          $run=mysqli_query($db,$select);
          while ($data=mysqli_fetch_assoc($run)) {
          ?>
            <form action="" method="post">
                <div class="form-floating mb-3">
                    <input type="text" name="name" value="<?php echo $data['name'] ?>" class="form-control" id="floatingInputUsername"
                        placeholder="Your Name" required   style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;">
                    <label for="floatingInputUsername">Your name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" value="<?php echo $data['email'] ?>" class="form-control" id="floatingInput"
                        placeholder="name@example.com" required  style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;" >
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" value="<?php echo $data['password'] ?>" class="form-control" id="floatingPassword"
                        placeholder="Password" required  style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;" >
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="number" value="<?php echo $data['number'] ?>" class="form-control" id="floatingnumber" placeholder="Number"
                        required  style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;" >
                    <label for="floatingnumber">Number</label>
                </div>
                <div class="mb-0">
                    <button type="submit" name="update-btn" class="btn text-white py-2 px-5 button-30" style="border-radius: 8px;background: #da70d6">Update</button>
                </div>

                </form>


         
          <?php } ?>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>