<?php

use Helpers\HTTP;
use Libs\Database\Invoices_Table;
use Libs\Database\MySQL;
use Libs\Models\Invoice;

include("../vendor/autoload.php");

$quantity = $_POST['quantity'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$item_id = $_POST['item_id'];
$item_title = $_POST['item_title'];
$item_price = $_POST['item_price'];

$payment_img = $_FILES['payment_img'];
$image_tmp = $payment_img['tmp_name'];
$image_name = $payment_img['name'];
$payment_img_url = "";

if(is_uploaded_file($image_tmp)){
    $path = "../invoices_images/" . $image_name;
    if(move_uploaded_file($image_tmp, $path)) {
        $payment_img_url = "http://localhost/invoice/invoices_images/" . $image_name;
    }
}

$table = new Invoices_Table(new MySQL());

if($quantity && $name && $phone && $address && $item_id && $item_title && $item_price){
    $invoice = new Invoice($quantity, $name, $phone, $address, $payment_img_url, $item_id, $item_title, $item_price);
    $result = $table->insert($invoice->toMap());
    if($result){
        HTTP::redirect("generate_invoice.php", "id=$item_id");
    } else{
        HTTP::redirect("generate_invoice.php", "id=$item_id");
    }
}