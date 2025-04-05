<?php

class Checkout_Controller_Cart_Order extends Core_Controller_Front_Action
{
    public function PlaceorderAction()
    {
        $cart = Mage::getSingleton('checkout/session')->getCart();
        $method = $cart->getPaymentMethod();
        if ($method == 'PayPal') {
            $this->redirect('paypal/transaction/start');
        } else if ($method == 'Case on Delivery') {
            $this->convertAction();
        }
    }

    public function convertAction()
    {
        $cart = Mage::getSingleton('checkout/session')->getCart();
        $order = Mage::getModel('Checkout/Convert_Order')->convert($cart);
        Mage::log($order);
        $id = $this->getRequest()->getQuery('transaction_id');

        Mage::getModel('Sales/Order_Payment')
            ->setOrderId($order)
            ->setAmount($cart->getTotalAmount())
            ->setPaymentMethod($cart->getPaymentMethod())
            ->setTransactionId($id)
            ->setStatus('success')
            ->save();

        $cart->setIsActive(0)->save();
        Mage::getSingleton('core/session')->remove('cart_id');
        $this->redirect('catalog/product/list');
    }
}
?>