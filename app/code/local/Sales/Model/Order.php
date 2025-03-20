<?php

class Sales_Model_Order extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Sales_Model_Resource_Order";
        $this->_collectionClassName = "Sales_Model_Resource_Order_Collection";
    }
    public function getItemCollection()
    {
        return Mage::getModel('Sales/Order_item')->getCollection()
            ->addFieldToFilter('order_id', $this->getOrderId());
    }
    public function getAddressCollection()
    {
        return Mage::getModel('sales/Order_Address')->getCollection()
            ->addFieldToFilter('order_id', $this->getOrderId());
    }

    public function getBillingAddress()
    {
        return $this->getAddressCollection()
            ->addFieldToFilter('address_type', 'Billing')
            ->getFirstItem();
    }
    public function getShippingAddress()
    {
        return $this->getAddressCollection()
            ->addFieldToFilter('address_type', 'Shipping')
            ->getFirstItem();
    }


}