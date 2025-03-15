<?php

class Checkout_Block_Cart_Address_Index extends Core_Block_Template
{
    public function getBillingAddress()
    {
        $cart_id = Mage::getSingleton('checkout/session')->getCart()->getCartId();
        return Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id', $cart_id)
            ->addFieldToFilter('address_type', 'Billing')
            ->getFirstItem();
    }
    public function getShippingAddress()
    {
        $cart_id = Mage::getSingleton('checkout/session')->getCart()->getCartId();
        return Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id', $cart_id)
            ->addFieldToFilter('address_type', 'Shipping')
            ->getFirstItem();
    }
    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }
    public function getAllShipping()
    {
        return Mage::getModel('checkout/cart_shipping')->getAllShipping();
    }
    public function getCartData()
    {
        return Mage::getSingleton('checkout/session')->getCart();
    }
    public function getCartItemData()
    {
        $items = Mage::getSingleton('checkout/session')->getCart()->getItemCollection()->getData();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->getSubtotal();
        }
        return $total;
    }

}