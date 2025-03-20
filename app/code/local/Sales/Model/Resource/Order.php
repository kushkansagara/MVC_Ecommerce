<?php

class Sales_Model_Resource_Order extends core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->init('order', 'order_id');
    }

}
?>