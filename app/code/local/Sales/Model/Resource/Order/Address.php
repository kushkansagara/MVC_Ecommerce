<?php

class Sales_Model_Resource_Order_Address extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('Order_address', 'address_id');
    }
}
?>