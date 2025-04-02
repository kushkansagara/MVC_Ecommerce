<?php
class Admin_Block_Account_Dashboard_Address extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('customer/account/dashboard/address.phtml');

    }
    // public function setOrderBlock($block)
    // {
    //     $this->_address = $block;
    //     return $this;
    // }

    // public function getBillingAddress()
    // {
    //     // die;
    //     return $this->getParent()->getOrder()->getBillingAddress();
    // }
    // public function getShippingAddress()
    // {
    //     // die;
    //     return $this->getParent()->getOrder()->getShippingAddress();
    // }
}
?>