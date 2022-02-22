<?php

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\Items_Table;
use Libs\Models\Item;
use Libs\Models\Items;

include("../vendor/autoload.php");

$title = $_POST['title'];
$price = $_POST['price'];

$image = $_FILES['image'];
$image_tmp = $image['tmp_name'];
$image_name = $image['name'];
$image_url = "";

if (is_uploaded_file($image_tmp)) {
    $path = "../items_images/" . $image_name;
    if (move_uploaded_file($image_tmp, $path)) {
        $image_url = "http://localhost/invoice/items_images/" . $image_name;
    }
}


$table = new Items_Table(new MySQL());

if ($title && $price) {
    $item = new Item($title, $image_url, $price);
    $result = $table->insert($item->toMap());
    if ($result) {
        HTTP::redirect("admin_panel_items.php", "success=true");
    } else {
        HTTP::redirect("admin_panel_items.php", "error=true");
    }
}