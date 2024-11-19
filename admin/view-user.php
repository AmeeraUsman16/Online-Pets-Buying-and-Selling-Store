<?php
require_once '../db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    header("Location: /pets");
    exit(); // Ensure the script stops here after redirection
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_status'])) {
    $userId = $_POST['user_id'];
    $currentStatus = $_POST['current_status'];

    // Toggle the status
    $newStatus = ($currentStatus === 'active') ? 'inactive' : 'active';

    // Update the user's status in the database
    $updateQuery = "UPDATE users SET status = '$newStatus' WHERE uid = '$userId'";
    mysqli_query($db, $updateQuery);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>


    <style>
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
            height: 35px;
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

<body style="background-color: rgb(245, 248, 250);">
    <?php
    require_once '../nav.php';
    require_once '../db.php';
    ?>
    <div class="container mt-5">
        <div class="container mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
                $select = "SELECT * FROM users WHERE role = 'buyer' OR role = 'seller'";
                $run = mysqli_query($db, $select);
                $count = 0;
                while ($data = mysqli_fetch_assoc($run)) {
                    $count++;
                    $buttonText = $data['status'] === 'active' ? 'Block' : 'Unblock';
                    $buttonStyle = $data['status'] === 'active' ? '#ff0000' : '#8cc46e';
                    ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $count ?></th>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $data['email'] ?></td>
                            <td><?php echo $data['role'] ?></td>
                            <td><?php echo $data['number'] ?></td>
                            <td>
                                <a href="edit-user.php?id=<?php echo $data['uid']; ?>" class="button-30"
                                    style="background: #da70d6">Edit</a>


                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="toggle_status" value="1">
                                    <input type="hidden" name="user_id" value="<?php echo $data['uid']; ?>">
                                    <input type="hidden" name="current_status" value="<?php echo $data['status']; ?>">
                                    <button type="submit" class="button-30" style="background: <?php echo $buttonStyle; ?>">
                                        <?php echo $buttonText; ?>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>



    <?php require_once '../footer.php'; ?>



</body>

</html>