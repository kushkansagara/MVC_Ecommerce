<?php
class Admin_Block_Sales_Order_View_info extends Core_Block_Template
{
    // protected $_info;
    public function __construct()
    {
        $this->setTemplate('Admin/sales/order/view/info.phtml');
    }
    // public function setOrderBlock($block)
    // {
    //     $this->_info = $block;
    //     return $this;
    // }

    public function getInfo()
    {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
        return $this->getParent()->getOrder();
    }


}
?>