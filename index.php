<?php
session_start();
require_once 'db.php';
if(isset($_POST['login-btn'])){
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
	$run = mysqli_query($db, $query);
    if (mysqli_num_rows($run)>=1) {
		$data = mysqli_fetch_assoc($run);
		if ($data['role']=='admin') {
			$_SESSION['aemail'] = $email;
            $_SESSION['userid']=$data['uid'];
			header("location:admin/index.php");
		}elseif($data['role']=='seller'){
			$_SESSION['email']=$email;
			$_SESSION['userid']=$data['uid'];
			$_SESSION['msg'] = "Welcome back dear ".$data['name'];
			header("location:seller/index.php");
		}else {
            $_SESSION['email']=$email;
			$_SESSION['userid']=$data['uid'];
			$_SESSION['msg'] = "Welcome back dear ".$data['name'];
			header("location:buyer/index.php");
        }
	}else{
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php  require_once 'nav.php' //Include Navigation bar?>
    <div class="container mt-5">
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control " id="floatingInput" placeholder="name@example.com" style="border: none; border-bottom: 1px solid #000; border-radius:0;width:700px;" 
                    required >
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" style="border: none; border-bottom: 1px solid #000; border-radius:0;width:700px;" 
                    required>
                <label for="floatingPassword">Password</label>
            </div>
            <div class="mb-0">
                <button type="submit" name="login-btn" class="btn btn-dark p-3 px-5" style="border-radius: 27px;">Login</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>