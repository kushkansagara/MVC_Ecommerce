<?php

class Checkout_Controller_Cart_Shipping extends Core_Controller_Front_Action
{
    public function shippingAction()
    {
        $shipping = $this->getRequest()->getParams();
        $shipping = Mage::getSingleton('checkout/session')
            ->getCart()
            ->setShippingMethod($shipping['shipping_method'])
            ->setShippingPrice($shipping['shipping_price'])
            ->save();
        $this->redirect('checkout/cart_shipping/index');
    }
    public function indexAction()
    {
        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Checkout/Cart_Shipping_Index')
            ->setTemplate('checkout/cart/shipping/index.phtml');
        $layout->getChild('content')->addChild('index', $index);
        $layout->getChild('head')->addCss('main.css')->addCss('checkout/cart/shipping/index.css')->addJs('checkout/cart/shipping/index.js');
        $layout->toHtml();
    }
    public function applyCouponAction()
    {
        $code = $this->getRequest()->getParams();
        $items = Mage::getSingleton('checkout/session')
            ->getCart()
            ->getItemCollection()
            ->getData();
        $total_price = 0;
        foreach ($items as $item) {
            $total_price += $item->getSubtotal();
        }
        $finalDiscount = Mage::getModel('checkout/coupon')
            ->calculateDiscount($code['coupon_code'], $total_price);
        if ($finalDiscount == 0) {
            $cart = Mage::getSingleton('checkout/session')
                ->getCart()
                ->setCouponCode('')
                ->setCouponDiscount($finalDiscount)->save();
            echo json_encode(["success" => false, "message" => "Coupon Code not Found"]);
        } else {
            $cart = Mage::getSingleton('checkout/session')
                ->getCart()
                ->setCouponCode($code['coupon_code'])
                ->setCouponDiscount($finalDiscount)->save();
            // echo json_encode(["success" => true, "message" => "Coupon Applied!"]);
        }
        $this->redirect('checkout/cart_shipping/index');
    }
}
?>