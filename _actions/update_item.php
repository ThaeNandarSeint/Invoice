<?php
    include "../vendor/autoload.php";

    use Libs\Database\MySQL;
    use Libs\Database\Items_Table;
    use Libs\Models\Item;
    use Helpers\HTTP;

    $id=$_GET['id'];

    $title = $_POST['title'];
    $image = $_FILES['image'];
    $image_tmp = $image['tmp_name'];
    $image_name = $image['name'];
    $image_url = $_POST['old_image'];
    $price = $_POST['price'];

    if(is_uploaded_file($image_tmp)){
        $path = "../items_images/" . $image_name;
        if(move_uploaded_file($image_tmp, $path)){
            $image_url = "http://localhost/invoice/items_images" . $image_name;
        }
    }

    $table = new Items_Table(new MySQL());

    if($title && $price){
        $item = new Item($title, $image_url, $price);
        $result = $table->edit($id, $item->toMap());

        if($result){
            HTTP::redirect("/", "success=true");
        } else {
            HTTP::redirect("/", "error=true");
        }
    } else {
        HTTP::redirect("/", "noUpdate=true");
    }