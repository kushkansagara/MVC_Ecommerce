<?php

class Customer_Block_Account_Address_Index extends Core_Block_Template
{
    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }

    public function getAddress()
    {
        $request = Mage::getModel('core/request')->getQuery('id');
        $address = Mage::getModel('customer/account_address')
            ->load($request);
        return $address;
    }
}
?>