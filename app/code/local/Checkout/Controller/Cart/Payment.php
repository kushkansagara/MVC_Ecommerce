<?php

class Checkout_Controller_Cart_Payment extends Core_Controller_Front_Action
{
    public function paymentAction()
    {
        $payment = $this->getRequest()->getParams();
        $payment = Mage::getSingleton('checkout/session')
            ->getCart()
            ->setPaymentMethod($payment['payment_method'])
            ->save();
        $this->redirect('checkout/cart_shipping/index');
    }
}
?>