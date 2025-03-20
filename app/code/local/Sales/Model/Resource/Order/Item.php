<?php

class Sales_Model_Resource_Order_Item extends core_Model_Resource_Abstract
{

    public function _construct()
    {
        $this->init('Order_item', 'item_id');
    }
}
?>