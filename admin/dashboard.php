<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body>
    <?php require_once '../nav.php' //Include Navigation bar ?>



    <div class="container mt-5">

        <div class=" d-flex justify-content-end">
            <label class="me-2">Filter By</label>
            <input type="radio" class="btn-check" name="options-outlined" id="today" autocomplete="off" checked>
            <label class="btn btn-outline-success" for="success-outlined">Today</label>

            <input type="radio" class="btn-check" name="options-outlined" id="week" autocomplete="off" checked>
            <label class="btn btn-outline-success" for="success-outlined">This Week</label>

            <input type="radio" class="btn-check" name="options-outlined" id="month" autocomplete="off" checked>
            <label class="btn btn-outline-success" for="success-outlined">Month</label>


            <input type="radio" class="btn-check" name="options-outlined" id="daily" autocomplete="off" checked>
            <label class="btn btn-outline-success" for="success-outlined">Daily</label>
        </div>


        <h2 class="text-secondary">Dashboard</h2>

        <!-- <div class="container">
    <div class="d-flex justify-content-end ">
        <div class="input-group rounded-start w-50 ">
            <input type="text" id="startDate" class="form-control rounded-start p-3" placeholder="Start Date" aria-label="Start Date">
            <span class="input-group-text">→</span>
            <input type="text" id="endDate" class="form-control p-3" placeholder="End Date" aria-label="End Date">
            <span class="input-group-text">
                <i class="bi bi-calendar"></i> 
            </span>
        </div>
    </div>
</div> -->


        <div class="row mt-5 bg-light rounded w-75">
            <div class="col-sm-4 p-5">Total Pets:</div>
            <div class="col-sm-4 border-top-0 border-bottom-0 border-start border-end p-5">Total Sellers: </div>
            <div class="col-sm-4 p-5">Total Buyers</div>
        </div>
        <div class="row mt-3 rounded bg-light w-25 p-5">
            <div class="col-sm ">Revenues</div>

        </div>

    </div>

    <?php require_once '../footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#startDate", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#endDate", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>
</body>

</html>