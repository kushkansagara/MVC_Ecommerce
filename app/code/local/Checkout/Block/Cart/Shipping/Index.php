<?php

class Checkout_Block_Cart_Shipping_Index extends Core_Block_Template
{

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
    public function getAllPayment()
    {
        return Mage::getModel('checkout/cart_payment')->getAllPayment();
    }
}