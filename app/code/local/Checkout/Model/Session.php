<?php

class Checkout_Model_Session extends Core_Model_Session
{
    public function getCart()
    {
        $cart_id = $this->get('cart_id');
        $customer_id = $this->get('customer_id');
        $cart_id = is_null($cart_id) ? 0 : $cart_id;
        $customer_id = is_null($cart_id) ? 0 : $customer_id;
        $cart = Mage::getModel('checkout/cart')->load($cart_id);

        if (!is_null($this->get('customer_id')) && $cart->getCustomerId() == 0) {
            $cart->setCustomerId($customer_id)
                ->save();
        }

        if (!$cart->getCartId()) {
            $cart->setCustomerId($customer_id)
                ->setTotalAmount(0)
                ->setCreatedAt(time())
                ->setUpdateAt(time())
                ->save();
            $this->set('cart_id', $cart->getCartId());
        }
        return $cart;
    }
}
?>