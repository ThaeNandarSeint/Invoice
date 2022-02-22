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
    <title>Show Items</title>
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
    <!-- itemMenu -->
    <div class="container-fluid mt-3" id="food">
        <h1 class="text-center">Items Menu</h1>
        <div class="container">
            <div class="row mb-4">
                <?php foreach ($items as $item) : ?>
                    <div onclick="location.href='form.php?id=<?= $item->id; ?>'" class="col-12 col-md-3">
                        <div class="rotate float-end"><?= $item->price ?> ks</div>
                        <img id="image" class="rounded" src="<?= $item->image ?>" alt="" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="title text-center bg-info"><?= $item->title ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="#" class="text-decoration-none">
                <p class="text-center text-danger">See All Items</p>
            </a>
            <!-- <form action="">
                <button type="submit" class="btn btn-success">Ok</button>
            </form> -->
        </div>
    </div>
    <!-- bootstrap js -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>