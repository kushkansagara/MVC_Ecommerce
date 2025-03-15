<?php

class Checkout_Model_Cart extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Checkout_Model_Resource_Cart";
        $this->_collectionClassName = "Checkout_Model_Resource_Cart_Collection";
    }
    public function addProduct($product_id, $quantity)
    {
        Mage::getModel('checkout/cart_item')
            ->setCartId($this->getCartId())
            ->setProductId($product_id)
            ->setProductQuantity($quantity)
            ->save();
        return $this;
    }
    protected function _beforeSave()
    {
        $oldData = $this->getItemCollection()->getData();
        $total = 0;
        foreach ($oldData as $old) {
            $total += $old->getSubtotal();
        }
        $total = $total - (int) $this->getCouponDiscount() + (int) $this->getShippingPrice();
        $discount = Mage::getModel('checkout/coupon')->calculateDiscount($this->getCouponCode(), $total);
        $this->setCouponDiscount($discount);
        $this->setTotalAmount($total);
    }

    public function getItemCollection()
    {
        return Mage::getModel('checkout/Cart_item')->getCollection()
            ->addFieldToFilter('cart_id', $this->getCartId());
    }
    public function removeItem($id)
    {
        $items = $this->getItemCollection()
            ->getData();
        foreach ($items as $item) {
            if ($item->getItemId() == $id) {
                $item->delete();
            }
        }
        return $this;
    }
    public function updateItem($cart_id, $quantity)
    {
        $items = $this->getItemCollection()
            ->getData();
        foreach ($items as $item) {
            if ($item->getItemId() == $cart_id) {
                $item->setProductQuantity($quantity)->save();

            }

        }
        return $this;

    }
}
?>