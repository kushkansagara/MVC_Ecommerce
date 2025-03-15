<?php

class Checkout_Model_Resource_Cart_Item extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('cart_item', 'item_id');
    }
}
?>