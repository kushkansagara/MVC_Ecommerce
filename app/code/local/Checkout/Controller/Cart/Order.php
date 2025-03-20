<?php

class Checkout_Controller_Cart_Order extends Core_Controller_Front_Action
{
    public function PlaceorderAction()
    {
        $cart = Mage::getSingleton('checkout/session')->getCart();
        Mage::getModel('Checkout/Convert_Order')->convert($cart);

        // $cart->setIsActive(0)->save();
        Mage::getSingleton('core/session')->remove('cart_id');
        $this->redirect('catalog/product/list');
    }
}
?>