<?php

class Customer_Block_Account_Dashboard extends Core_Block_Template
{
    protected $_parentOrder;

    public function __construct()
    {
        $this->setTemplate('customer/account/dashboard.phtml');
    }
    public function setOrder($block)
    {
        $this->_parentOrder = $block;
        return $this;
    }
    public function getOrder()
    {
        return $this->_parentOrder;
    }

    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }

    public function getCustomer()
    {
        $session = Mage::getSingleton('core/session');
        return Mage::getModel('customer/account')->load($session->get('customer_id'), 'customer_id');
        // return Mage::getModel('customer/account')
        //     ->getCollection()
        //     ->addFieldToFilter('customer_id', $session->get('customer_id'))
        //     ->getFirstItem();
    }
    public function getCustomerAddress()
    {
        $session = Mage::getSingleton('core/session');
        return Mage::getModel('customer/account_address')
            ->getCollection()
            ->addFieldToFilter('customer_id', $session->get('customer_id'))
            ->getData();
    }
    public function getOrderData()
    {
        $session = Mage::getSingleton('core/session');
        return Mage::getModel('sales/order')
            ->getCollection()
            ->addFieldToFilter('customer_id', $session->get('customer_id'))
            ->getData();
    }
}
?>