<?php
class Admin_Block_Order extends Core_Block_Template
{
    public function getOrderData()
    {
        return Mage::getModel('sales/order')->getCollection()->getData();
    }
}
?>