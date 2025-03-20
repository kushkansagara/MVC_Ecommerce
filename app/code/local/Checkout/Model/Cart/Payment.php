<?php

class Checkout_Model_Cart_Payment extends Core_Model_Abstract
{
    public function getAllPayment()
    {
        $PaymentArray = [
            'Case on Delivery',
            'Credit Card',
            'PayPal',
            'UPI',
        ];
        return $PaymentArray;
    }
}
?>