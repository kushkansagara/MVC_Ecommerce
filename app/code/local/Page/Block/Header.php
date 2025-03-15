<?php

class Page_Block_Header extends Core_BLock_Template
{
    protected $_rootCategory;
    public function __construct()
    {
        $this->setTemplate('page/header.phtml');
    }

    public function getCategory()
    {
        $_rootCategory = Mage::getModel('catalog/category')->getCollection()->getData();
        return $_rootCategory;
    }
    public function getCartData()
    {
        $cart_id = Mage::getSingleton('checkout/session')->get('cart_id');
        return count(Mage::getModel('checkout/cart_item')->getCollection()->addFieldToFilter('cart_id', $cart_id)->getData());
    }
    public function getMainSubCategory()
    {
        return Mage::getModel('catalog/category')->getCollection()->addFieldToFilter('parent_id', 1)->getData();
    }
}

?>