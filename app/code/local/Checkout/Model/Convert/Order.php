<?php
class Checkout_Model_Convert_Order
{
    public function convert($cart)
    {

        $cartData = $cart->getData();
        unset($cartData['cart_id']);

        $order = Mage::getModel('sales/order')
            ->setData($cartData)
            ->save();
        // die;
        $order_id = $order
            ->getOrderId();

        $items = $cart
            ->getItemCollection()
            ->getData();
        $order_item = Mage::getModel('sales/order_item');
        foreach ($items as $key => $value) {
            $value = $value
                ->getData();
            unset($value['item_id']);
            $order_item
                ->setData($value)
                ->setOrderId($order_id)
                ->save();
        }

        $Billingaddress = $cart->getBillingAddress()->getData();
        unset($Billingaddress['cart_id']);
        unset($Billingaddress['address_id']);
        $BillingOrderAddress = Mage::getModel('Sales/order_address')
            ->setData($Billingaddress)
            ->setOrderId($order_id)
            ->save();

        $Shippingaddress = $cart
            ->getShippingAddress()
            ->getData();
        unset($Shippingaddress['address_id']);
        unset($Shippingaddress['cart_id']);
        $ShippingOrderAddress = Mage::getModel('Sales/order_address')
            ->setData($Shippingaddress)
            ->setOrderId($order_id)
            ->save();

        return $order_id;
    }
}
?>