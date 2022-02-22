<?php
    namespace Libs\Models;

    class Item {
        private $title;
        private $image;
        private $price;

        public function __construct(
            $title, $image, $price
        )
        {
            $this->title = $title;
            $this->image = $image;
            $this->price = $price;
        }

        public function toMap(){
            $map = [
                'title' => $this->title,
                'image' => $this->image,
                'price' => $this->price
            ];
            return $map;
        }
    }