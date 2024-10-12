<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pets Details</title>

    <style>
        .div-styl {
            background-color: red;
            margin-top: 100px;
        }


        .button-30 {
            align-items: center;
            appearance: none;
            background-color: #FAF0E6;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            box-sizing: border-box;
            color: #36395A;
            cursor: pointer;
            display: inline-flex;
            font-family: 'Roboto', sans-serif;
            height: 48px;
            width: 120px;
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
            box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        }

        .button-30:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .button-30:active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
        }
    </style>
</head>

<body>

    <?php include 'nav.php'; ?>

    <div class="mt-5 mb-5  container rounded" style="background:rgba(255, 99, 71, 0.2);height:450px">
        <!-- Adding padding for better spacing -->
        <div class="row d-flex justify-content-between ">

            <div class="col-md-6 mt-4 d-flex justify-content-center" >
                <img src="uploads/66fc51d4daf09.jpg" alt="Pets_image" class="rounded  w-75 h-100 ">
            </div>

            <div class="col-md-6 container ms-0 mt-4 " style="max-width:390px;height:400px">
                <div class="text-center mt-2 text-secondary">
                    <h1>Sparrow</h1>
                    <h2>Breed</h2>
                </div >
                <p class="mt-3 text-secondary">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis rerum, nobis hic
                    id maiores aperiam officia saepe sunt labore,
                    ipsa quod ullam blanditiis asperiores ratione in harum consequuntur voluptates corporis!</p>
                    <div class="d-flex align-items-center mt-5">
                        <button class="btn text-white  button-30" style="background: #FF6F61">Add to Cart</button>
                        <h3 style="margin-left:140px">rs.1550</h3>
                    </div>
          </div>
        </div>
    </div>
  




    <?php include 'footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>