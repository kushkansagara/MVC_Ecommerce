<?php
class Customer_Model_Resource_Account extends core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->init('customer_account', 'customer_id');
    }
}
?>