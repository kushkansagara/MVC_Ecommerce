<?php

class Sales_Model_Resource_Order_Payment extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('order_payment', 'payment_id');
    }
}
?>