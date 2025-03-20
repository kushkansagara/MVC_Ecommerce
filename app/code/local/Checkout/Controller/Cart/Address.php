<?php

class Checkout_Controller_Cart_Address extends Core_Controller_Front_Action
{
    public function saveAction()
    {
        $address_data = $this->getRequest()->getParams();

        $cart = Mage::getSingleton('checkout/session')
            ->getCart()->setEmail($address_data['Email'])->save();

        if ($address_data['billing']) {

            $address = Mage::getModel('checkout/cart_address')
                ->setFirstName($address_data['Firstname'])
                ->setLastName($address_data['Lastname'])
                ->setPhoneNumber($address_data['Phonenumber']);

            foreach ($address_data['billing'] as $key => $billingItem) {
                $columnName = "set{$key}";
                $address->$columnName($billingItem);
            }
            $address->setCartId($cart->getCartId())->setAddressType('Billing')->save();
        }
        if ($address_data['shipping']) {

            $address = Mage::getModel('checkout/cart_address')
                ->setFirstName($address_data['Firstname'])
                ->setLastName($address_data['Lastname'])
                ->setPhoneNumber($address_data['Phonenumber']);
            foreach ($address_data['shipping'] as $key => $shippingItem) {
                $columnName = "set{$key}";
                $address->$columnName($shippingItem);
            }
            $address->setCartId($cart->getCartId())->setAddressType('Shipping')->save();
        }
        $this->redirect('checkout/cart_shipping/index');

    }
    public function indexAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Checkout/Cart_Address_Index')
            ->setTemplate('checkout/cart/address/index.phtml');
        $layout->getChild('content')->addChild('index', $index);
        $layout->getChild('head')->addCss('main.css')->addCss('checkout/cart/address/index.css')->addJs('checkout/cart/address/index.js');
        $layout->toHtml();
    }
}
?>