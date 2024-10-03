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

    <link rel="stylesheet" href="../assets/css/index.css">
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

      #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
      }

      .image-hover-effect {

        transition: transform 0.3s ease-in-out;
        /* Smooth transition effect */
      }

      .image-hover-effect:hover {
        transform: scale(1.05);
        /* Slightly increase the size on hover */
      }



      .btn-hover-effect {
        background-color: black;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        transition: transform 0.3s ease-in-out;
        /* Smooth transition effect */
      }

      .btn-hover-effect:hover {
        transform: scale(1.05);
        /* Slightly increase the size on hover */
      }

 


 
.button-39 {
  background-color: #FFFFFF;
  border: 1px solid rgb(209,213,219);
  border-radius: .5rem;
  box-sizing: border-box;
  color: #111827;
  font-family: "Inter var",ui-sans-serif,system-ui,-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  font-size: .875rem;
  font-weight: 600;
  line-height: 1.25rem;
  padding: .75rem 1rem;
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
  background-color: rgb(249,250,251);
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
    <!-- <img class="w-100" src="../assets/images/animals-pets-banner.jpg" alt=""> -->
    <img class="w-100" style="max-height:500px" src="../assets/images/Pink-Green2.png" alt="Pink_Green_banne">
    <div class="container">
      <h1 class="fw-bold text-center mt-5 mb-3">Meet Your Next Best Friend</h1>
    </div>

    <div class="container">
      <div class="row">
        <?php
        $select = "SELECT*FROM tblpets";
        $run = mysqli_query($db, $select);
        $count = 0;
        while ($data = mysqli_fetch_assoc($run)) {
          $count++;
          ?>



          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4"> <!-- Change the column size as needed -->
            <div class="card" style="background-color:#FAF0E6">
              <img class="card-img-top pet-card-image" src="../uploads/<?php echo $data['image']; ?>" alt="Pets_image">
              <div class="card-body">
                <div class="d-flex justify-content-between  align-items-center"> <!-- Flex container -->
                  <strong class="card-title"><?php echo $data['petType']; ?></strong>
                  <strong class="card-title"><?php echo $data['price']; ?></strong>
                </div>
                <p class="card-text"><?php echo $data['breed']; ?></p>
                <!-- <p class="card-text"><?php echo $data['description']; ?></p> -->
                <a href="#" class="button-39" role="button" style="margin-left:50px;">Buy</a>
                <a href="#" class="button-39" role="button">Add to Cart</a>
              </div>
            </div>

          </div>

        <?php } ?>


      </div>
    </div>


    <div class="container d-flex justify-content-between">
      <div class="row">
        <div class="col-6">
          <img id="myImg" src="../assets/images/dog.webp" alt="pet_dog" class="w-100 image-hover-effect">
        </div>
        <div class="col-6 ps-5">
          <h3 class="fs-2 fw-medium">Pets for Any Need</h3>
          <p class="fs-6 text-gray">We take great satisfaction in offering a broad and diverse range of products to meet
            your pet's specific requirements, making it your go-to source for pet supplies near
            you. Our Online Pet Supplies Store in Pakistan has everything you need, whether you have an
            aquatic friend, a curious dog, a restless bird,
            or a warm pet. We provide everything you need, from pet treats
            and treats to bright colors and comfortable bedding.</p>
        </div>
      </div>
    </div>

<div class="container" style="margin-top:50px;">

  <h2>How It Works: Simple Steps to Buy or Sell a Pet</h2>
<p>Buying or selling pets on Pet's Heaven is simple and straightforward.
   Whether you're looking for a new furry friend or a loving home for your pet, 
   creating an account is necessary to start. As a buyer, you can browse through
    a wide range of pets by category—dogs, cats, birds, and more. Once you find 
    a pet that catches your eye, you can view detailed information, including photos 
    and descriptions, and directly contact the seller for more details. 
    After connecting with the seller, you can finalize the transaction 
    through our secure payment system. For sellers, it’s just as easy: 
    create an account, list your pet with all relevant details, set your price,
     and start receiving inquiries from potential buyers. Once a buyer is found,
      you can arrange the sale and ensure your pet goes to a loving home.</p>


</div>








    <!-- Remove the container if you want to extend the Footer to full width. -->

    <!-- Footer -->
    <footer class="text-center " style="background-color:#FAF0E6">
      <!-- Grid container -->
      <div class="container">
        <!-- Section: Links -->
        <section class="mt-5">
          <!-- Grid row-->
          <div class="row text-center d-flex justify-content-center pt-5">
            <!-- Grid column -->
            <div class="col-md-2">
              <h6 class="text-uppercase font-weight-bold">
                <a href="#!" >About us</a>
              </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2">
              <h6 class="text-uppercase font-weight-bold">
                <a href="#!" >Products</a>
              </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2">
              <h6 class="text-uppercase font-weight-bold">
                <a href="#!" >Awards</a>
              </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2">
              <h6 class="text-uppercase font-weight-bold">
                <a href="#!" >Help</a>
              </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2">
              <h6 class="text-uppercase font-weight-bold">
                <a href="#!" >Contact</a>
              </h6>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row-->
        </section>
        <!-- Section: Links -->

        <hr class="my-5" />

        <!-- Section: Text -->
        <section class="mb-5">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                distinctio earum repellat quaerat voluptatibus placeat nam,
                commodi optio pariatur est quia magnam eum harum corrupti
                dicta, aliquam sequi voluptate quas.
              </p>
            </div>
          </div>
        </section>
        <!-- Section: Text -->

        <!-- Section: Social -->
        <section class="text-center mb-5">
          <a href="" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-google"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-github"></i>
          </a>
        </section>
        <!-- Section: Social -->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
      </script>

  </body>

  </html>