<?php
class Admin_Block_Sales_Order_View extends Core_Block_Template
{
    protected $_parentOrder;

    public function __construct()
    {
        $this->setTemplate('Admin/sales/order/view.phtml');
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
    public function getSubtotal()
    {
        $orderProducts = $this->getOrder()->getItemCollection()->getData();
        $total = 0;
        foreach ($orderProducts as $orderProduct) {
            $total += $orderProduct->getSubtotal();
        }
        return $total;
    }
}
?>