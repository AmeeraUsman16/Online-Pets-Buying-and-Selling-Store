<?php
session_start();
$id = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

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
            height: 210px;
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
    <!-- <img class="w-100" src="./assets/images/animals-pets-banner.jpg" alt=""> -->
    <img class="w-100" style="max-height:500px" src="./assets/images/Pink-Green2.png" alt="Pink_Green_banne">
    <div class="container">
        <h1 class="fw-bold text-grayv1 text-center mt-5 mb-4">Meet Your Next Best Friend</h1>
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
                    <div class="card border-0 pb-1" style="background-color:#fff3e8;;">
                        <img class="card-img-top pet-card-image" src="./uploads/<?php echo $data['image']; ?>"
                            alt="Pets_image" onclick="window.location.href='http://localhost/pets/pet-details.php'" ;>
                        <div class="card-body">
                            <div class="d-flex justify-content-between  align-items-center"> <!-- Flex container -->
                                <strong
                                    class="card-title text-capitalize fw-normal text-gray mb-0"><?php echo $data['petType']; ?></strong>
                                <strong class="card-title text-gray fw-normal mb-0"><?php echo $data['price']; ?></strong>
                            </div>
                            <p class="card-text mb-3 text-capitalize fs-7 text-accent"><?php echo $data['breed']; ?></p>
                            <!-- <p class="card-text"><?php echo $data['description']; ?></p> -->
                            <!-- <a href="#" class="button-39" role="button" style="margin-left:50px;">Buy</a> -->

                            <?php if ($role !== 'seller'): ?>
                                <div class="d-flex justify-content-end">
                                    <button class="button-39 py-2.5 mt-0 border-0 text-gray add-to-cart-btn"
                                        data-id="<?php echo $data['petID']; ?>" data-pet-type="<?php echo $data['petType']; ?>"
                                        data-price="<?php echo $data['price']; ?>" data-breed="<?php echo $data['breed']; ?>"
                                        data-image="<?php echo $data['image']; ?>">
                                        Add to Cart
                                    </button>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>


    <div class="container d-flex justify-content-between mt-5">
        <div class="row">
            <div class="col-6">
                <img id="myImg" src="./assets/images/dog.webp" alt="pet_dog" class="w-100 image-hover-effect">
            </div>
            <div class="col-6 ps-5">
                <h3 class="fs-2 fw-medium text-grayv1">Pets for Any Need</h3>
                <p class="fs-6 text-gray">We take great satisfaction in offering a broad and diverse range of products
                    to meet
                    your pet's specific requirements, making it your go-to source for pet supplies near
                    you. Our Online Pet Supplies Store in Pakistan has everything you need, whether you have an
                    aquatic friend, a curious dog, a restless bird,
                    or a warm pet. We provide everything you need, from pet treats
                    and treats to bright colors and comfortable bedding.</p>
            </div>
        </div>
    </div>

    <div class="container mt-5 align-items-center">
        <div class="row align-items-center justify-content-between">

            <div class="col-7">
                <h3 class='text-grayv1 fs-2'>How It Works: Simple Steps to Buy or Sell a Pet</h3>
                <p class='text-gray'>Buying or selling pets on Pet's Heaven is simple and straightforward.
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

            <div class="col-4">
                <img class='w-100 rounded' src="./assets/images/image-buy-sell.webp" alt="">
            </div>
        </div>

    </div>


    <?php require_once './footer.php'; //Include Foot ?>


    <!-- CART NOTIFICATION -->

    <div id="success-alert" class="alert alert-success align-items-center gap-2 fs-7 position-fixed font-thin border-0"
        role="alert" style="display: none; bottom:20px; right:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-circle-check">
            <circle cx="12" cy="12" r="10" />
            <path d="m9 12 2 2 4-4" />
        </svg> Pet added to cart successfully
    </div>
    <div id="error-alert" class="alert alert-danger align-items-center gap-2 fs-7 position-fixed font-thin border-0"
        role="alert" style="display: none; bottom:20px; right:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-octagon-alert">
            <path d="M12 16h.01" />
            <path d="M12 8v4" />
            <path
                d="M15.312 2a2 2 0 0 1 1.414.586l4.688 4.688A2 2 0 0 1 22 8.688v6.624a2 2 0 0 1-.586 1.414l-4.688 4.688a2 2 0 0 1-1.414.586H8.688a2 2 0 0 1-1.414-.586l-4.688-4.688A2 2 0 0 1 2 15.312V8.688a2 2 0 0 1 .586-1.414l4.688-4.688A2 2 0 0 1 8.688 2z" />
        </svg> Pet is already in the cart!
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartButtons = document.querySelectorAll('.add-to-cart-btn');
            const cartBadge = document.getElementById('cart-badge');
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            const isLoggedIn = <?php echo !empty($id) ? 'true' : 'false'; ?>;

            function updateCartCount() {
                const cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
                cartBadge.textContent = cart.length; // Update badge count with the number of items
            }

            // Update cart count on page load

            cartButtons.forEach(button => {
                button.addEventListener('click', function () {
                    if (!isLoggedIn) {
                        // Redirect to login page if not logged in
                        window.location.href = 'login.php';
                        return;
                    }

                    const petId = this.getAttribute('data-id');
                    const petType = this.getAttribute('data-pet-type');
                    const price = this.getAttribute('data-price');
                    const breed = this.getAttribute('data-breed');
                    const image = this.getAttribute('data-image');

                    const pet = {
                        id: petId,
                        type: petType,
                        price: price,
                        breed: breed,
                        image
                    };

                    // Get existing cart items from localStorage
                    let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

                    // Check if the pet is already in the cart
                    const petExists = cart.find(item => item.id === petId);

                    if (!petExists) {
                        // Add the new pet to the cart
                        cart.push(pet);
                        localStorage.setItem('cart', JSON.stringify(cart));
                        updateCartCount()

                        // Show success notification
                        showNotification('success');
                    } else {
                        // Show error notification
                        showNotification('error');
                    }
                });
            });

            // Function to show and hide notifications
            function showNotification(type) {
                const alert = type === 'success' ? successAlert : errorAlert;

                alert.style.display = 'flex';  // Show the alert

                // Hide the alert after 3 seconds
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000);
            }
        });
    </script>

</body>

</html>