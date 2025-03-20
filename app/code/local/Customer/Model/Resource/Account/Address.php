<?php

class Customer_Model_Resource_Account_Address extends core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->init('customer_account_address', 'address_id');
    }
}
?>