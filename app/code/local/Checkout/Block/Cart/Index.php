<?php

class Checkout_Block_Cart_Index extends Core_Block_Template
{
    public function getItem()
    {
        return Mage::getSingleton('checkout/session')
            ->getCart()
            ->getItemCollection()
            ->getData();
    }
    public function getCart()
    {
        $cart_id = Mage::getSingleton('checkout/session')->getCart();
        return $cart_id;
    }
    public function Subtotal()
    {
        $datas = $this->getItem();
        $total = 0;
        foreach ($datas as $data) {
            $total += $data->getSubtotal();
        }
        return $total;
    }
    // public function getCart()
    // {

    // }
}
?>