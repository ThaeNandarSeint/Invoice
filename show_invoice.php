<?php

include "vendor/autoload.php";

use Libs\Database\MySQL;
use Libs\Database\Invoices_Table;
use Libs\Models\Invoice;
use Helpers\HTTP;

$invoice_id = $_GET['id'];

$table = new Invoices_Table(new MySQL());
$invoice = $table->getById($invoice_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Invoice</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center">TRIOSYS</h1>
        <h3 class="text-center">IT Services & Solutions</h3>
        <h5 class="text-info text-center">support@triosys.info</h5>
        <h6 class="text-center">09-777400744</h6>
        <hr>
        <h2 class="text-center text-info">INVOICE</h2>
        <h6>Customer</h6>
        <div class="row">
            <div class="col-12 col-md-8">
                <p><?= $invoice->name ?></p>
                <p><?= $invoice->address ?></p>
                <p><?= $invoice->phone ?></p>
            </div>
            <div class="col-12 col-md-4">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Invoice No.</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>Thornton</td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td>Thornton</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table -->
        <table class="table table-borderless mt-3">
            <thead>
                <tr class="table-active">
                    <th scope="col">NO.</th>
                    <th scope="col">Description</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?= $invoice->id ?></th>
                    <td><?= $invoice->item_title ?></td>
                    <td><?= $invoice->quantity ?></td>
                    <td><?= $invoice->item_price ?></td>
                    <td><?= ($invoice->quantity) * ($invoice->item_price) ?></td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="row">
            <div class="col-12 col-md-8">
            </div>
            <div class="col-12 col-md-4">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Net Total</th>
                            <th scope="col">201000</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Discount</td>
                            <td>15%</td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td>201000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- address -->
        <div class="row mt-3">
            <div class="col-12 col-md-8">
                <span class="d-block">Co-operative Bank Ltd., (CB Bank)</span>
                <span class="d-block">Account Name:</span>
                <span class="d-block">Account No:</span>
            </div>
            <div class="col-12 col-md-1"></div>
            <div class="col-12 col-md-2">
                <div class="border border-dark">
                    <span class="d-block text-center">Issued by</span>
                    <span class="d-block text-center">TRIOSYS</span>
                </div>
            </div>
            <div class="col-12 col-md-1"></div>
        </div>
        <h3 class="text-center mt-3">Do you want to generate your invoice?</h3>
        <form action="">
            <button type="submit" class="float-end btn btn-success">Generate</button>
        </form>
    </div>
    <!-- bootstrap js -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>