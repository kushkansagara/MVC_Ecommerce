<?php

class Checkout_Controller_Cart
{
    public function indexAction()
    {
        // echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Checkout/Cart_Index')
            ->setTemplate('checkout/cart/index.phtml');
        $layout->getChild('content')->addChild('index', $index);

        $layout->toHtml();
    }
    public function updateAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $update = $layout->createBlock('Checkout/Cart_Update')
            ->setTemplate('checkout/cart/update.phtml');
        $layout->getChild('content')->addChild('update', $update);

        $layout->toHtml();
    }
    public function removeAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $remove = $layout->createBlock('Checkout/Cart_Remove')
            ->setTemplate('checkout/cart/remove.phtml');
        $layout->getChild('content')->addChild('remove', $remove);

        $layout->toHtml();

    }
    public function addAction()
    {
        echo "asdas";
        $layout = Mage::getBlock('Core/Layout');
        $add = $layout->createBlock('Checkout/Cart_Add')
            ->setTemplate('checkout/cart/add.phtml');
        $layout->getChild('content')->addChild('add', $add);

        $layout->toHtml();
    }
}

?>