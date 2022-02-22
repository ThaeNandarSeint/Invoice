<?php

include "vendor/autoload.php";

use Libs\Database\MySQL;
use Libs\Database\Items_Table;

$table = new Items_Table(new MySQL());
$items = $table->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Items</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .title {
            opacity: 0;
        }

        #image:hover+.title {
            opacity: 1;
            background-color: aqua;
            transform: translateY(-100%);
        }

        .rotate {
            display: none;
            color: white;
            background-color: red;
            display: inline-block;
            transform: translateY(100%);
            padding: 2px 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
            <form class="d-flex float-end">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        <button class="btn btn-primary" id="new"><i class="fas fa-plus me-2"></i>New Item</button>
        <!-- itemMenu -->
        <div class="container-fluid mt-3" id="food">
            <h1 class="text-center">Items Menu</h1>
            <div class="container">
                <div class="row mb-4">
                    <?php foreach ($items as $item) : ?>
                        <div class="col-12 col-md-3">
                            <div class="rotate float-end"><?= $item->price ?> ks</div>
                            <img id="image" class="rounded" src="<?= $item->image ?>" alt="" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="title text-center bg-info"><?= $item->title ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="#" class="text-decoration-none">
                    <p class="text-center text-danger">See All Items</p>
                </a>
            </div>
        </div>
        <!-- form -->
        <div class="container-fluid mt-3 d-none" id="form">
            <form action="_actions/new_item.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Description for item</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                    <div class="invalid-feedback">
                        required!
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image for item</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    <div class="invalid-feedback">
                        required!
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" id="price" class="form-control" required>
                    <div class="invalid-feedback">
                        required!
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- bootstrap js -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- js -->
    <script>
        // toggle newFood
        const newPost = document.querySelector("#new");
        const form = document.querySelector("#form");
        const food = document.querySelector("#food");
        newPost.addEventListener('click', function() {
            food.classList.toggle('d-none');
            form.classList.toggle('d-none');
        });
        // validation
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>