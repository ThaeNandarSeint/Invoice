<?php

include "vendor/autoload.php";

use Libs\Database\MySQL;
use Libs\Database\Invoices_Table;
use Libs\Models\Invoice;
use Helpers\HTTP;

$item_id = $_GET['id'];

$table = new Invoices_Table(new MySQL());
$invoices = $table->getByItem($item_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class=" ">Choose your name</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($invoices as $invoice) : ?>
                    <tr onclick="location.href='show_invoice.php?id=<?= $invoice->id ?>'">
                        <th scope="row"><?= $invoice->id ?></th>
                        <td><?= $invoice->name ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- bootstrap js -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
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