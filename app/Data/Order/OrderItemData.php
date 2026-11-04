<?php

namespace App\Data\Order;

use Kakaprodo\CustomData\Data;

class OrderItemData extends Data
{
   
        public int $id;

        public int $order_id;

        public int $product_id;

        public int $quantity;

        public float $price;
        
        public float $total_price;

}