<?php
class Admin_Block_Sales_Order_View_Item extends Core_Block_Template
{
    // protected $_orderItem;

    public function __construct()
    {
        $this->setTemplate('Admin/sales/order/view/item.phtml');
    }
    // public function setOrderBlock($block)
    // {
    //     $this->_orderItem = $block;
    //     return $this;
    // }
    public function getItem()
    {
        return $this->getParent()->getOrder()->getItemCollection();

    }
    public function getProductName($product_id)
    {
        return Mage::getModel('catalog/product')
            ->getCollection()
            ->addFieldToFilter('product_id', $product_id);
    }
}
?>