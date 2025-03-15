<?php

class Checkout_Model_Coupon extends Core_Model_Abstract
{
    public function getAllCoupon()
    {
        $couponArray = [
            'WELCOME10' => '10%',
            'OFF50' => '50',
            'SUMMER20' => '20%',
            'OFF100' => '100',
            'SAVE5' => '5%',
            'DEAL30' => '30%',
        ];
        return $couponArray;
    }
    public function calculateDiscount($coupon_code, $total_price)
    {
        $allCoupon = $this->getAllCoupon();
        if (isset($allCoupon[$coupon_code])) {
            $disvalue = $allCoupon[$coupon_code];

            if (str_contains($disvalue, '%')) {
                $percentage = str_replace('%', '', $disvalue);
                $final_price = ($total_price * $percentage) / 100;
            } else {
                $final_price = $disvalue;
            }
            return $final_price;
        }
        return 0;
    }
}
?>