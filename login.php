<?php
session_start();
require_once 'db.php';
if (isset($_POST['login-btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
    $run = mysqli_query($db, $query);
    if (mysqli_num_rows($run) >= 1) {
        $data = mysqli_fetch_assoc($run);
        if ($data['role'] == 'admin') {
            $_SESSION['email'] = $email;
            $_SESSION['userid'] = $data['uid'];
            header("location:admin/index.php");
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['userid'] = $data['uid'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['msg'] = "Welcome back dear " . $data['name'];
            header("location:/pets/index.php");
        }
        // } elseif ($data['role'] == 'seller') {
        //     $_SESSION['email'] = $email;
        //     $_SESSION['userid'] = $data['uid'];
        //     $_SESSION['role'] = $data['role'];
        //     $_SESSION['msg'] = "Welcome back dear " . $data['name'];
        //     header("location:/index.php");
        // } else {
        //     $_SESSION['email'] = $email;
        //     $_SESSION['userid'] = $data['uid'];
        //     $_SESSION['msg'] = "Welcome back dear " . $data['name'];
        //     header("location:/index.php");
        // }
    } else {
        echo "<div class='alert alert-danger mb-0 mt-3'>Invalid Email or Password</div>";

    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/index.css">
    <style>
        .div-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FAF0E6;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #4F000000 0 -3px 0 inset;
            box-sizing: border-box;
            color: white;
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
    </style>
</head>

<body>
    <?php require_once 'nav.php' //Include Navigation bar ?>
    <div class="container mt-20 " style="margin-bottom:150px;margin-top:130px;">
        <div class="container mt-5 div-form text-secondary">
            <!-- Add enctype="multipart/form-data" to enable file uploads -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control " id="floatingInput"
                        placeholder="name@example.com" required
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;">
                    <label for="floatingInputType">Email </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                        placeholder="Password" required
                        style="border: none; border: 1px solid #cdcdcd; border-radius:8px;width:700px;">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="mb-0">
                    <button type="submit" name="login-btn" style="background: #FF6F61"
                        class="btn text-white py-2 px-5 button-30" style="border-radius: 8px;">Login</button>
                    <!-- <button class="button-30" role="button" type="submit" name="login-btn" >Add</button> -->
                </div>
            </form>
        </div>
    </div>

    <?php require_once 'footer.php'; //Include Footer ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>