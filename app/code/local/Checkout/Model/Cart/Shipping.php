<?php

class Checkout_Model_Cart_Shipping extends Core_Model_Abstract
{
    public function getAllShipping()
    {
        $shippingArray = [
            'standard' => 5,
            'express' => 15,
            'overnight' => 25,
            'free' => 0,
        ];
        return $shippingArray;
    }
}
?>