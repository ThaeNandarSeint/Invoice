<?php

include "vendor/autoload.php";

use Libs\Database\MySQL;
use Helpers\HTTP;
use Libs\Database\Items_Table;

$id = $_GET['id'];

$table = new Items_Table(new MySQL());
$item = $table->getById($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="css/index.css">
</head>

<body class="bg-light">
    <div class="container-fluid">
        <h3 class="mx-auto text-center" style="width: 50%;">Fill this form to confirm your order.</h3>
        <form action="_actions/new_invoice.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
            <div class="card my-3 mx-auto" style="max-width: 50%;">
                <div class="row g-0 m-3">
                    <div class="col-md-4">
                        <input type="hidden" name="item_id" value="<?= $item->id ?>">
                        <input type="hidden" name="item_title" value="<?= $item->title ?>">
                        <input type="hidden" name="item_price" value="<?= $item->price ?>">
                        <img src="<?= $item->image ?>" class="img-fluid rounded-start" alt="..." style="height: 150px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title d-inline"><?= $item->title ?></h3>
                            <h5 class="card-text text-danger float-end"><?= $item->price ?> ks</h5>
                            <div class="form-group mt-3">
                                <label for="quantity" class="form-label"><b>Quantity</b></label>
                                <input type="text" name="quantity" id="quantity" class="form-control" required>
                                <div class="invalid-feedback">*required!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-3 mx-auto" style="max-width: 50%;">
                <div class="form-group my-3 mx-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    <div class="invalid-feedback">Name is required!</div>
                </div>
                <div class="form-group mb-3 mx-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="number" name="phone" id="phone" class="form-control" required>
                    <div class="invalid-feedback">Phone Number is required!</div>
                </div>
                <div class="form-group mb-3 mx-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" cols="30" rows="10" class="form-control" required></textarea>
                    <div class="invalid-feedback">Address is required!</div>
                </div>
                <div class="form-group mb-3 mx-3">
                    <label for="payment" class="form-label">Payment Method:</label>
                    <div class="ms-3">
                        <div class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#kbz">KBZ Pay</div>
                        <div class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#wave">Wave Pay</div>
                    </div>
                    <div class="invalid-feedback">Please select one of them!</div>
                    <!-- KBZ Pay -->
                    <div class="modal fade" id="kbz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">SCAN HERE TO PAY</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center align-items-center">
                                    <img src="image/kbzPay.jpg" alt="" style="height: 300px">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it!</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wave Pay -->
                    <div class="modal fade" id="wave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">SCAN HERE TO PAY</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center align-items-center">
                                    <img src="image/kbzPay.jpg" alt="" style="height: 300px">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3 mx-3">
                    <label for="payment_img" class="form-label">Payment screenshot:</label>
                    <input type="file" name="payment_img" id="payment_img" class="form-control" accept="image/*" required>
                    <div class="invalid-feedback">Payment screenshot is required!</div>
                </div>
                <div class="form-group mb-3 mx-3">
                    <button type="submit" class="btn" style="background-color: rgba(248, 159, 99, 0.883); color: white;">Confirm Order</button>
                </div>
            </div>
        </form>
    </div>

    <!-- bootstrap js -->
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- custom js -->
    <script>
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
