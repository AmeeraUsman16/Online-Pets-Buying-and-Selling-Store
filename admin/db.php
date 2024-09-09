<?php
    $localhost = "localhost";
    $username = "root";
    $pass = "";
    $db_name = "petsdb";
    $db  = mysqli_connect($localhost , $username , $pass , $db_name);
if ($db==false) {
	echo "error in making connection with database ! <br>";
}

  ?>