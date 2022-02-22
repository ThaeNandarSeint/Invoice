<?php

namespace Libs\Models;

class Invoice{
    private $quantity;
    private $name;
    private $phone;
    private $address;
    private $payment;
    private $item_id;
    private $item_title;
    private $item_price;

    public function __construct($quantity, $name, $phone, $address, $payment, $item_id, $item_title, $item_price)
    {
        $this->quantity = $quantity;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->payment = $payment;
        $this->item_id = $item_id;
        $this->item_title = $item_title;
        $this->item_price = $item_price;
    }

    public function toMap(){
        $map = [
            "quantity" => $this->quantity,
            "name" => $this->name,
            "phone" => $this->phone,
            "address" => $this->address,
            "payment" => $this->payment,
            "item_id" => $this->item_id,
            "item_title" => $this->item_title,
            "item_price" => $this->item_price
        ];
        return $map;
    }
}