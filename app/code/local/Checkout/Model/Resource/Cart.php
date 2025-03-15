<?php

class Checkout_Model_Resource_Cart extends core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->init('cart', 'cart_id');
    }

}
?>