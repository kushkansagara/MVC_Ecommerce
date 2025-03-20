<?php

class Checkout_Controller_Cart extends Core_Controller_Customer_Action
{
    public function indexAction()
    {
        // echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Checkout/Cart_Index')
            ->setTemplate('checkout/cart/index.phtml');
        $layout->getChild('content')->addChild('index', $index);
        $layout->getChild('head')->addCss('main.css')->addCss('checkout/cart/index.css')->addJs('checkout/cart/index.js');

        $layout->toHtml();
    }
    public function updateAction()
    {
        $items = $this->getRequest()->getParams();
        $cartItem = Mage::getSingleton('checkout/session')
            ->getCart()->updateItem($items['item_id'], $items['quantity'])->save();
        $this->redirect('checkout/cart/index');
    }
    public function removeAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $cartItem = Mage::getSingleton('checkout/session')
            ->getCart()->removeItem($id)->save();
        $this->redirect('checkout/cart/index');
    }
    public function addAction()
    {
        $data = $this->getRequest()->getParams();
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        Mage::getSingleton('checkout/session')->getCart()
            ->addProduct($data['product_id'], $data['quantity'])
            ->save();
        $this->redirect('checkout/cart/index');

    }



}

?>