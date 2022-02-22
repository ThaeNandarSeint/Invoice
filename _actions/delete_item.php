<?php

include "../vendor/autoload.php";

use Libs\Database\MySQL;
use Libs\Database\Items_Table;
use Libs\Models\Item;
use Helpers\HTTP;

$id = $_GET['id'];

$table = new Items_Table(new MySQL());
$result = $table->delete($id);
if($result){
    HTTP::redirect("/", "success=true");
} else {
    HTTP::redirect("/", "error=true");
}