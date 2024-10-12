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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="./assets/css/index.css">

  <style>
    .pet-card-image {
      width: 100%;
      max-width: 300px;
      height: 250px;
      object-fit: cover;
    }

    @media screen and (max-width: 580px) {
      .pet-card-image {
        max-width: none;
      }
    }

    .button-39 {
      background-color: #FFFFFF;
      border: 1px solid rgb(209, 213, 219);
      border-radius: .5rem;
      box-sizing: border-box;
      color: #636363;
      font-family: "Inter var", ui-sans-serif, system-ui, -apple-system, system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      font-size: .805rem;
      font-weight: 600;
      line-height: 1.25rem;
      padding: .65rem 1rem;
      text-align: center;
      text-decoration: none #D1D5DB solid;
      text-decoration-thickness: auto;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      cursor: pointer;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;

    }

    .button-39:hover {
      background-color: rgb(249, 250, 251);
    }

    .button-39:focus {
      outline: 2px solid transparent;
      outline-offset: 2px;
    }

    .button-39:focus-visible {
      box-shadow: none;
    }
  </style>
</head>

<body>
  <?php
  require_once 'nav.php';
  require_once 'db.php';
  ?>

  <div class="container">
    <div class="row">
      <?php
      $select = "SELECT*FROM tblpets";
      $run = mysqli_query($db, $select);
      $count = 0;
      while ($data = mysqli_fetch_assoc($run)) {
        $count++;
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4" style="margin-top:70px">
          <!-- Change the column size as needed -->
          <div class="card border-0 pb-1" style="background-color:#fff3e8">
            <img class="card-img-top pet-card-image" src="./uploads/<?php echo $data['image']; ?>" alt="Pets_image">
            <div class="card-body">
              <div class="d-flex justify-content-between  align-items-center"> <!-- Flex container -->
                <strong
                  class="card-title text-capitalize fw-normal text-gray mb-0"><?php echo $data['petType']; ?></strong>
                <strong class="card-title text-gray fw-normal mb-0"><?php echo $data['price']; ?></strong>
              </div>
              <p class="card-text mb-3 text-capitalize fs-7 text-accent"><?php echo $data['breed']; ?></p>
              <div class="d-flex justify-content-end">
                <button class="button-39 py-2.5 mt-0 border-0 text-gray" role="button" href="cart-pets.php">Add to
                  Cart</button>
              </div>



              <!-- <a href="cart-pets.php" class="btn btn-primary">Add to Cart</a> -->
            </div>
          </div>

        </div>

      <?php } ?>


    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

  <?php require_once './footer.php'; //Include Footer ?>
</body>

</html>